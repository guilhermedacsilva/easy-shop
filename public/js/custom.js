$("form[confirm]").each(function(index,element) {
    $(element).submit(function(event){
        if (!confirm('Are you sure?')) {
            event.preventDefault();
        }
    });
});

navigateTo = function(url) {
    window.location.href = url;
};
