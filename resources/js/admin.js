$(document).ready(function ($) {
    console.log("sige admin");
    loadFilters();
    loadCategorias();
    loadCiudades();
    //// cargando las posiciones de los mapas
    if (typeof google !== 'undefined') {
        console.log(google);
        // the variable is defined
        var initialLocation = new google.maps.LatLng(23.13302, -82.38304);
        if($("#map_create").length>0){
            initMap();
        }

    }

    $('.listing-views a').click(function (ev) {
        ev.preventDefault();
        $('ul.listing-views li').removeClass('active');
        $(this).parent().addClass('active');
        $('.listing .row').addClass('hide');
        $('.listing .row.' + $(this).attr('name')).removeClass('hide');
    });

    $('#filter').submit(function (ev) {
        ev.preventDefault();
        console.log($(this).find('i'));
        $(this).find('i').first().addClass('hide');
        $(this).find('i').last().removeClass('hide');
        $.post('../api/filter', $('#filter').serialize(), function (data) {
            showFilterResult(data.services);
            $('#filter button').find('i').last().addClass('hide');
            $('#filter button').find('i').first().removeClass('hide');
        });
    });

    $('select[name="order"]').change(function () {
        $('.popular_listings .item').remove();
        $('.loading_popular_listings').removeClass('hide');
        $.get('../api/' + $(this).val(), function (data) {
            $('.loading_popular_listings').addClass('hide');
            $.each(data.data, function () {
                $('.loading_popular_listings').parent().append(getFilterResultElement(this));
            });
        });
    });

    $('.popular_listings button').click(function () {
        window.location.href = 'home/servicesbyfilter/' + $('select[name="order"]').val();
    })

    $('.step-views .f1-step a').click(function (ev) {
        ev.preventDefault();
        $('.step-views .f1-step').removeClass('active');
        $(this).parent().addClass('active');
        $('.item-step').removeClass('active');
        console.log($('#' + $(this).attr('name')));
        //valorar calcular progresbar aqui tambien
        $('#' + $(this).attr('name')).addClass('active');
    });
    //agregando horarios

    $('#add_time').click(function(){
        console.log("click en add_time");
        var values = $('input[name="week_days[]"]:checked').map(function(){
            return $(this).val();
        }).get();
        var start_time=$('input[name="start_time"]').val();
        var end_time=$('input[name="end_time"]').val();

        var value = $('#times').val(); //retrieve array
        value = JSON.parse(value);
        if(values.length>0) {
            value.push(
                {
                    weekdays: values,
                    start_time: start_time,
                    end_time: end_time
                });

            $('#times').val(JSON.stringify(value)); //store array
            $('input[name="week_days[]"]').prop('checked', false); // Unchecks it
            pintarHorarios();
        }

    })

    $('.f1 .item-step:first').fadeIn('slow');



    // next step
    $('.f1 .btn-next').on('click', function() {
        var parent_fieldset = $(this).parents('.item-step');
        var next_step = true;
        // navigation steps / progress steps
        var current_active_step = $(this).parents('.f1').find('.f1-step.active');
        var progress_line = $(this).parents('.f1').find('.f1-progress-line');
        // fields validation


        if( next_step ) {
            parent_fieldset.fadeOut(400, function() {
                // change icons
                current_active_step.removeClass('active').addClass('activated').next().addClass('active');
                // progress bar
                bar_progress(progress_line, 'right');
                // show next step
                $(this).next().fadeIn();
                // scroll window to beginning of the form
                scroll_to_class( $('.f1'), 20 );
            });
        }

    });

    // previous step
    $('.f1 .btn-previous').on('click', function() {
        // navigation steps / progress steps
        var current_active_step = $(this).parents('.f1').find('.f1-step.active');
        var progress_line = $(this).parents('.f1').find('.f1-progress-line');

        $(this).parents('.item-step').fadeOut(400, function() {
            // change icons
            current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
            // progress bar
            bar_progress(progress_line, 'left');
            // show previous step
            $(this).prev().fadeIn();
            // scroll window to beginning of the form
            scroll_to_class( $('.f1'), 20 );
        });
    });


    $("#userfile").change(function(event){
        console.log("cambiando imagen");
        $('#image_preview').html("");
        var total_file=document.getElementById("userfile").files.length;
        for(var i=0;i<total_file;i++)
        {
            $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");
        }
        $('#image_preview').removeClass("hide")
    });
    $("#submitform").click(function(){
        console.log("date submit joedr");
        $( "form.f1" ).submit();
        console.log("date submit cojo");
        $( ".fl" ).submit();
    });

    $('.card-link.delete-image').on('click', function (ev) {
        ev.preventDefault();
        var value = $('#images_deleted').val(); //retrieve array
        value = JSON.parse(value);
        if ($(this).hasClass('remove-icon')) {
            $(this).removeClass('remove-icon');
            $(this).addClass('add-icon');
            $(this).find('i').removeClass('fa-trash');
            $(this).find('i').addClass('fa-check');
            value.push(this.id);
        } else {
            $(this).removeClass('add-icon');
            $(this).addClass('remove-icon');
            $(this).find('i').removeClass('fa-check');
            $(this).find('i').addClass('fa-trash');
            value.splice(value.indexOf(this.id), 1);
        }
        $('#images_deleted').val(JSON.stringify(value));
    });
});
function getStringDays(days){
    var result= [];
    var textos = $('input[name="week_days[]"]').map(function(){
        return $(this).data("day");
    }).get();
    for(var i=0;i<days.length;i++){
        result.push(textos[days[i]*1]);
    }
    return result.join(",");
}
function removeTime(i){
    var value = $('#times').val(); //retrieve array
    value = JSON.parse(value);
    value.splice(i,1);
    $('#times').val(JSON.stringify(value));
    pintarHorarios();
}
function scroll_to_class(element_class, removed_height) {
    var scroll_to = $(element_class).offset().top - removed_height;
    if($(window).scrollTop() != scroll_to) {
        $('html, body').stop().animate({scrollTop: scroll_to}, 0);
    }
}
function bar_progress(progress_line_object, direction) {
    var number_of_steps = progress_line_object.data('number-of-steps');
    var now_value = progress_line_object.data('now-value');
    var new_value = 0;
    if(direction == 'right') {
        new_value = now_value + ( 100 / number_of_steps );
    }
    else if(direction == 'left') {
        new_value = now_value - ( 100 / number_of_steps );
    }
    progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
}

function listPositions(){
    var value = $('#positions').val(); //retrieve array
    value = JSON.parse(value);

    var result = "";
    for(var i =0; i<value.length;i++){
        result+="<div class='position row'><div class='col-md-9 col-xs-9'><i class='fa fa-location-arrow'></i> <span class='title'> "+value[i].title+"</span><span class='start_time_s'>"+value[i].latitude+"</span> , <span class='end_time_s'>"+value[i].longitude+"</span></div><div class='col-md-3 col-xs-3'><input type='button' value='X' class='btn btn-danger' onclick='removePosition("+i+");' /></div></div><br>";
    }
    $("#visual_positions").html(result);


    console.log(result);
}
function removePosition(i){
    var value = $('#positions').val(); //retrieve array
    value = JSON.parse(value);
    $.each(gmarkers, function (indexInArray) {
        if (this.name == value[i].title) {
            this.setMap(null);
            gmarkers.splice(indexInArray, 1);
            return;
        }
    });
    value.splice(i, 1);
    $('#positions').val(JSON.stringify(value));
    listPositions();
}
function pintarHorarios(){
    var value = $('#times').val(); //retrieve array
    value = JSON.parse(value);

    var result = "";
    for(var i =0; i<value.length;i++){
        result+="<div class='horario row'><div class='col-md-9 col-xs-9'><i class='fa fa-calendar'></i> <span class='title'> "+getStringDays(value[i].weekdays)+"</span><span class='start_time_s'>"+value[i].start_time+"</span><span class='end_time_s'>"+value[i].end_time+"</span></div><div class='col-md-3 col-xs-3'><input type='button' value='X' class='btn btn-danger' onclick='removeTime("+i+");' /></div></div><br>";
    }
    $("#visual_horarios").html(result);


    console.log(result);

}
//llenandolos filtros
function loadFilters() {

    $.get('../api/cities', function (data) {
        $(data.data).each(function (pos, item) {
            var newState = new Option(item.title, item.id, false, false);
            // Append it to the select
            $("#cities2").append(newState).trigger('change');
        });

    });
    //$.get('../api/categories',function(data){
    $.get('../api/allsubcategories', function (data) {
        $(data.data).each(function (pos, item) {
            var newState = new Option(item.title, item.id, false, false);
            // Append it to the select
            $("#categories").append(newState).trigger('change');
        });
    });

}

function loadCategorias() {
    $.get('../api/categoriesloaded', function (data) {
        $(data.data).each(function (pos, category) {
            var elemento = '<div class="col-md-6" *ngFor="let category of categories">' +
                '            <h5 class="industry-title">' + category.title + '</h5>' +
                '        <ul class="industry-list list-unstyled mb0">';
            $(category.subcategoriesLists).each(function (pos2, subcategory) {
                elemento += '<li><a href="home/servicesbycategories/' + category.id + '/' + subcategory.id + '">' + subcategory.title +
                    '<span class="count">' + subcategory.count + '</span></a></li>'
            });
            elemento += '</ul></div>';
            $("#listado_categoria").append(elemento);
        });
    });
}

function loadCiudades() {
    $.get('../api/cities', function (data) {
        $(data.data).each(function (pos, city) {
            var elemento = '<div class="col-md-6 industry-list list-unstyled mb0">  ' +
                '<li ><a href="click_citi()">' + city.title + '<span class="count">(' + city.servicesCount + ')</span></a></li></div>';
            $("#listado_ciudades").append(elemento);
        });
    });
}

function showFilterResult(services) {
    $('#filterresult').removeClass('hide');
    $('#filterresultcontent').children().remove();
    if (!services.length) {
        $('#filterresultcontent').append('<p>No hay servicios con esas características.</p>')
    } else {
        $.each(services, function () {
            $('#filterresultcontent').append(getFilterResultElement(this));
        });
        $('#filterresultcontent .uou-accordions').uouAccordions();
    }
    $("html, body").animate({scrollTop:$('#filterresult').offset().top - 50},800)
}

function initMap() {
    var initialLocation = new google.maps.LatLng(23.13302, -82.38304);
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        });
    }
    const mapOptions = {
        center: initialLocation,
        zoom: 10,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        zoomControl: true,
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: false,
        rotateControl: true,
        fullscreenControl: false
    };
    var maps = $("#map_create").gmap3(mapOptions);
    console.log(maps)
    maps.on("click",function(algo1,algo2) {
        addMarker2(algo1,algo2);
        google.maps.event.clearListeners(algo1, 'click');
    });
    $('#addPosition').click(function (t) {
        var titulo = $("#positiontitle").val();
        if(lastPosition!=null&&titulo.length>0){
            console.log("creando el objeto");
            var value = $('#positions').val(); //retrieve array
            value = JSON.parse(value);
            value.push(
                {
                    title:titulo,
                    latitude:lastPosition.lat(),
                    longitude:lastPosition.lng()
                });
            $('#positions').val(JSON.stringify(value));
            listPositions();
            lastPosition =null;
            maps.on("click",function(algo1,algo2) {
                addMarker2(algo1,algo2);
                google.maps.event.clearListeners(algo1, 'click');
            });
            $("#positiontitle").val('');
            $("#positiontitle").removeClass('input-error');
        }

    })
}
var lastPosition= null;
function addMarker2(map, location) {
    var lattn = location.latLng;
    lastPosition = lattn;
    var ltn = lattn.lat();
    var lng = lattn.lng();
    var initialLocation = new google.maps.LatLng(ltn, lng)
    var marker = new google.maps.Marker({
        name: $("#positiontitle").val(),
        position: initialLocation,
        map: map,
        draggable: true
    });
    gmarkers.push(marker);
    map.panTo(initialLocation);
    google.maps.event.addListener(marker, 'dragend', function () {
        lastPosition = marker.getPosition();
        console.log("ueeeeoooo", lastPosition);
    });
}



function getFilterResultElement(service) {
    var prof = '', list = '';
    if (service.professional)
        prof = '<div class="marker-ribbon">' +
            '<div class="ribbon-banner">' +
            '<div class="ribbon-text">Profesional</div>' +
            '</div>' +
            '</div>';
    var rate = service.globalrate;
    for (var i = 0; i < 10; i++) {
        if (i < rate)
            list += '<li><i class="fa fa-star"></i></li>';
        else
            list += '<li><i class="fa fa-star-o"></i></li>';
    }

    var images = '';
    $.each(service.imagesList, function () {
        images+= '<li class="" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;"><img src="' + this.title + '" alt="" draggable="false"></li>';
    });
    var element = '<div class="col-md-4 listing-grid listing-grid-2 item">' +
        '<div class="listing-heading">' +
        prof +
        '<h5><a href="services/show/' + service.id + '">' + service.title + '</h5>' +
        '</div>' +
        '<div class="listing-inner">' +
        '<div class="flexslider default-slider">' +
        '<ul class="slides">\n' +
        '<li class="flex-active-slide" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity:1; display: block; z-index: 2;">\n' +
        '<img src="' + service.icon + '" alt="" draggable="false">' +
        '</li>\n' +
        images +
        '</ul>' +
        '<div class="reviews">' +
        '<ul class="rate">' +
        list +
        '</ul>' +
        '<span class="count">' + service.ratereviews + '</span>' +
        '</div>' +
        '<ol class="flex-control-nav flex-control-paging">\n' +
        '<li><a class="">1</a></li>\n' +
        '<li><a class="flex-active">2</a></li>\n' +
        '<li><a class="">3</a></li>\n' +
        '<li><a class="">4</a></li>\n' +
        '</ol>\n' +
        '<ul class="flex-direction-nav">\n' +
        '<li><a class="flex-prev" href="#"></a></li>\n' +
        '<li><a class="flex-next" href="#"></a></li>\n' +
        '</ul>' +
        '</div>' +
        '<ul class="uou-accordions">' +
        '<li class="">' +
        '<a href="#"><i class="fa fa-info main-icon"></i> Información</a>' +
        '<div>' +
        '<h5 class="title">' + service.subtitle + '</h5>' +
        '<p>' + service.description + '</p>' +
        '</div>' +
        '</li>' +
        '<li class="active">' +
        '<a href="#"><i class="fa fa-envelope main-icon"></i> Información adicional</a>' +
        '<div>' +
        '<ul class="contact-info list-unstyled mb0">' +
        '<li><i class="fa fa-map-marker"></i> ' + service.address + '</li>' +
        '<li><i class="fa fa-envelope-o"></i> ' + service.email + '</li>' +
        '<li><i class="fa fa-globe"></i> ' + service.url + '</li>' +
        '<li><i class="fa fa-phone"></i> ' + service.phone + '</li>' +
        '<li><i class="fa fa-fax"></i> ' + service.other_phone + '</li>' +
        '</ul>' +
        '</div>' +
        '</li>' +
        '</ul> <!-- end .uou-accordions -->' +
        '</div>' +
        '<div class="info-footer">' +
        '<img height="20" width="20" src="' + service.subcategoriesList[0].icon + '"> ' +
        '<h6>' + service.subcategoriesList[0].title + '</h6>' +
        '<a class="pull-right pl10" title="Destruir" href="services/destroy/' + service.id + '">' +
        '<i class="fa fa-trash bookmark"></i></a>' +
        '<a class="pull-right pl10" title="Editar" href="services/edit/' + service.id + '">' +
        '<i class="fa fa-edit bookmark"></i></a>' +
        '<a class="pull-right" title="Ver" href="services/show/' + service.id + '">' +
        '<i class="fa fa-eye bookmark"></i></a>' +
        '</div>' +
        '</div>';
    return element;
}




