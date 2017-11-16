$(document).foundation();

$(document).ready(function() {
    /* hide pour que ce soit masqué au départ */
    jQuery('#connectInputs').hide();
    /*ensuite je démarre onclick */
    $('#button').on('click', function(event) {
        $(this).closest('.menu').find('#connectInputs').toggle({ direction: "left" }, 1000);
        /* Vérification que l'action a été réalisée. SI c'est le cas, je transforme le bouton en OK */
        event.isPropagationStopped()
        $('#button').replaceWith('<button id="newButton" class="button" type="submit">OK !</button>');
    });

    /* au clic sur déconnexion redirige vers logout */
   /* $('#logout').on('click', function(event) {
        $(this).
    })*/
});
