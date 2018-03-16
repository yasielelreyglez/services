$(document).ready(function($) {
    console.log("sige admin");
    loadFilters();
    loadCategorias();
    loadCiudades();
    //// cargando las posiciones de los mapas
    if (typeof google !== 'undefined') {
        console.log(google);
        // the variable is defined
        var initialLocation =  new google.maps.LatLng(23.13302, -82.38304);
        var map = $("#map-top").gmap3({
            center: [23.13302, -82.38304],
            zoom: 4
        });
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                $("#map-top").gmap3({
                    center: [initialLocation],
                    zoom: 4
                });
            });
        }

        $.get('../api/mvpositions',function(data){
            $(data.data).each(function(pos,item){
                console.log("item",item,pos);
                const marker = new google.maps.Marker({
                    map: this.map,
                    position:new google.maps.LatLng(item.latitude, item.longitude),
                    title:item.title,
                    animation: google.maps.Animation.DROP,
                });
                $('#map-top').gmap3('get').marker(marker);
            })
        });
    }


});
//llenandolos filtros
    function loadFilters(){

        $.get('../api/cities',function(data){
            $(data.data).each(function(pos,item){
                console.log(item);
                var newState = new Option(item.title, item.id, false, false);
                // Append it to the select
                $("#cities2").append(newState).trigger('change');
            });

        });
        $.get('../api/categories',function(data){
            $(data.data).each(function(pos,item){
                console.log(item);
                var newState = new Option(item.title, item.id, false, false);
                // Append it to the select
                $("#categories").append(newState).trigger('change');
            });
        });

    }

    function loadCategorias(){
        $.get('../api/categoriesloaded',function(data){
            $(data.data).each(function(pos,category){
                console.log(category);
                var elemento = '<div class="col-md-6" *ngFor="let category of categories">' +
                    '            <h5 class="industry-title">'+category.title+'</h5>' +
                    '        <ul class="industry-list list-unstyled mb0">' ;
                    $(category.subcategoriesLists).each(function(pos2,subcategory){
                        elemento += '<li><a href="categories/' + category.id + '/subcategories/' + subcategory.id+'">'+subcategory.title+
                            '<span class="count">'+subcategory.count+'</span></a></li>'
                    });
                  elemento +='</ul></div>';
                $("#listado_categoria").append(elemento);
            });
        });
    }

    function loadCiudades(){
    $.get('../api/cities',function(data){
        $(data.data).each(function(pos,city){
            console.log(city);
            var elemento = '<div class="col-md-6 industry-list list-unstyled mb0">  ' +
            '<li ><a href="click_citi()">'+city.title+'<span class="count">('+city.servicesCount+')</span></a></li></div>';
            $("#listado_ciudades").append(elemento);
        });
    });
}

