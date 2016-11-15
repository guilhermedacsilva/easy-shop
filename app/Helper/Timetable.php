<?php

namespace Gym\Helper;

use Carbon\Carbon;
use Gym\Helper\GraphColoring;

/* Days > Hours */
class Timetable {

    const HOUR_HEIGHT_PIXEL = 60;
    const SESSION_MIN_HEIGHT = 17;

    public $days;
    public $headers;
    public $hours;
    public $columnHeight;

    public function createColumns($sessions)
    {
        $this->days = array_fill(0, 7, []);
        $minHour = 7;
        $maxHour = 22;
        foreach ($sessions as $session)
        {
            // week day to index
            $dayIndex = self::weekDayIndex($session);

            // remove seconds
            $hour = self::hourToFloat($session->start_at_time);
            $duration = self::hourToFloat($session->end_at_time) - $hour;

            if ($hour < $minHour) $minHour = $hour;
            if ($hour > $maxHour) $maxHour = $hour;

            $item = self::createItem($hour, $duration, $session);
            $this->insertSession($dayIndex, $item);
        }
        $this->hours = [];
        for ($i = $minHour; $i <= $maxHour; $i++)
        {
            $this->hours[] = sprintf("%02d:00", $i);
        }
        $this->headers = [];
        for ($i = 0; $i < 7; $i++)
        {
            $this->headers[] = MyDate::dayOfCurrentWeek($i)->format('D (M j)');
        }
        $this->columnHeight = self::HOUR_HEIGHT_PIXEL * ($maxHour - $minHour + 1);
        foreach ($this->days as &$day)
        {
            foreach ($day as &$item)
            {
                $item['css_top'] = 20 + ($item['start_float'] - $minHour) * self::HOUR_HEIGHT_PIXEL;
            }
        }
    }

    protected function insertSession($dayIndex, $item)
    {
        $graph = new GraphColoring();
        $conflicts = $this->findConflicts($graph, $dayIndex, $item);
        if (!empty($conflicts))
        {
            $this->changeCSS($graph, $dayIndex, $item, $conflicts);
        }
        $this->days[$dayIndex][] = $item;
    }

    protected function findConflicts($graph, $dayIndex, $item)
    {
        $conflicts = [];
        foreach ($this->days[$dayIndex] as $key => $session)
        {
            if (self::areOverlapping($item, $session))
            {
                $conflicts[] = $key;
                $this->mapConflictsRecursively([$key], $graph, $dayIndex);
            }
        }
        return $conflicts;
    }

    protected static function areOverlapping($session1, $session2)
    {
        return ($session1['start_float'] >= $session2['start_float'] && $session1['start_float'] < $session2['end_float'])
            || ($session1['end_float'] > $session2['start_float'] && $session1['end_float'] <= $session2['end_float'])
            || ($session1['start_float'] < $session2['start_float'] && $session1['end_float'] > $session2['end_float']);
    }

    protected function mapConflictsRecursively($needToMap, $graph, $dayIndex)
    {
        while ($tempKey = array_pop($needToMap))
        {
            $mappedKey = $graph->mapSomeKeys($tempKey)[0];
            if ($graph->needToAddToGraph($mappedKey))
            {
                $newConflicts = $this->days[$dayIndex][$tempKey]['conflicts'];
                $mappedConflicts = $graph->mapSomeKeys($newConflicts);
                $graph->addToGraph($mappedKey, $mappedConflicts);
                $needToMap = array_merge($needToMap, $newConflicts);
            }
        }
    }

    protected function changeCSS($graph, $dayIndex, & $item, $conflicts)
    {
        $mappedConflicts = $graph->mapSomeKeys($conflicts);
        $graph->addToGraph(1, $mappedConflicts);
        $graph->fillGaps();
        $graph->initColoring();
        $colors = $graph->getColors();
        $cssBaseValue = 95 / count($colors);
        $offset = 0;
        foreach ($colors as $keys)
        {
            foreach ($keys as $mappedKey)
            {
                if ($mappedKey == 1)
                {
                    $item['css_left'] = $cssBaseValue * $offset;
                    $item['css_width'] = $cssBaseValue;
                }
                else
                {
                    $this->days[$dayIndex][$graph->getFromFlippedMap($mappedKey)]['css_left'] = $cssBaseValue * $offset;
                    $this->days[$dayIndex][$graph->getFromFlippedMap($mappedKey)]['css_width'] = $cssBaseValue;
                }
            }
            $offset++;
        }
        $item['conflicts'] = $conflicts;
    }

    protected static function hourToFloat($hour)
    {
        return intval(substr($hour, 0, 2)) + intval(substr($hour, 3, 2)) / 60.0;
    }

    /* Rotates the week day, so the week starts at monday */
    protected static function weekDayIndex($session)
    {
        $weekDay = Carbon::parse($session->start_at_date)->dayOfWeek;
        return $weekDay > 0 ? $weekDay - 1 : 6;
    }

    protected static function createItem($hour, $duration, $session)
    {
        $height = intval($duration * self::HOUR_HEIGHT_PIXEL) - 2;
        $start_at_time = substr($session['start_at_time'], 0, -3);
        $end_at_time = substr($session['end_at_time'], 0, -3);
        return [
            'conflicts' => [],
            'start_float' => $hour,
            'end_float' => $hour + $duration,
            'duration' => $duration,
            'session' => $session,
            'css_top' => 0,
            'css_left' => 0,
            'css_width' => 95,
            'css_height' => $height < self::SESSION_MIN_HEIGHT ? self::SESSION_MIN_HEIGHT : $height,
            'title' => "From {$start_at_time} to {$end_at_time}",
        ];
    }

}
