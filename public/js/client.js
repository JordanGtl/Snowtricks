//////////////////////////////////////////////////////////////////////////////////////
// Trick Ajax
//////////////////////////////////////////////////////////////////////////////////////
$( ".LoadMoreComment" ).click(function(e) {
    e.preventDefault();

    var index = parseInt($(this).attr('data-index'));
    var newindex = index + parseInt($(this).attr('data-baseindex'));
    var parent = $(this);

    $.ajax({
        url: "/TrickCom/" + $(this).attr('data-id') + "/" + index,
        cache: false
    })
        .done(function( data )
        {
            console.log(data);

            if(data.length == 0)
            {
                $('.ModalAlertTitle').text('Commentaires');
                $('.ModalAlertContent').text('Tout les commentaires ont été chargés, il n\'y a plus de nouveau commentaire');
                $("#myModalAlert").modal();
            }
            else
            {
                for(var i =0; i < data.length; ++i)
                {
                    var box = $('.CommentData:first').clone();
                    box.find('.Author').html(data[i].author);
                    box.find('.Date').html(data[i].date);
                    box.find('.Content').html(data[i].content);

                    $('.CommentBox').append(box);
                }

                parent.attr('data-index', newindex);
            }

        });
});

$( ".LoadMoreFigure" ).click(function(e) {
    e.preventDefault();

    var index = parseInt($(this).attr('data-index'));
    var newindex = index + parseInt($(this).attr('data-baseindex'));
    var parent = $(this);

    $.ajax({
        url: "/TrickLoad/" + index,
        cache: false
    })
    .done(function( data ) {
        console.log(data);

        if(data.length == 0) {
            $('.ModalAlertTitle').text('Chargement des figures');
            $('.ModalAlertContent').text('Les dernieres figures ont déjà été chargées');
            $("#myModalAlert").modal();
        }
        else
        {
            for(var i =0; i < data.length; ++i)
            {
                var box = $('.FigureBox:first').clone();
                box.find('.FigureLoadName').html(data[i].name);
                $('.FiguresList').append(box);
            }
        }

        parent.attr('data-index', newindex);
    });
});

$( document ).ready(function()
{
    $('.alert').delay(3000).fadeOut(5000);

    $('.InputTrickName').each(function()
    {
        $('.FigureName').text($(this).val());
    });
});

//////////////////////////////////////////////////////////////////////////////////////
// Trick Medias
//////////////////////////////////////////////////////////////////////////////////////
$('.btnmodalmediadel').click(function()
{
    var id = $(this).attr('data-id');

    $.ajax({
        url: "/MediaDel/" + id,
        cache: false
    })
        .done(function( data ) {
            console.log(data);

            if(data.result == false)
                alert('supression erreur');
            else
            {
                $('.TrickTrashBtn2').each(function(){
                    if($(this).attr('data-id') == id)
                    {
                        console.log($(this));
                        $(this).closest('.FigureBox').remove();
                    }
                });
            }
        });
});

$('.TrickTrashBtn2').click(function() {
    $('.btnmodalmediadel').attr('data-id', $(this).attr('data-id'));
});

$('.TrickSetMasterPic').click(function(){
    var id = $(this).attr('data-id');
    var trick = $(this).attr('data-trick');
    var trickname = $(this).attr('data-trickname');
    var parent = $(this);

    $.ajax({
        url: "/MediaSetCover/" + trick + "/" + id,
        cache: false
    })
        .done(function( data )
        {
            if(data.result == false)
                alert('Erreur lors du choix de la photo de couverture');
            else {
                document.location.href = '/Trick/' + trickname + '/edit';
            }
        });
});

$('.ShowMedia').click(function()
{
    $('.FiguresMedia').removeClass('d-none');
    $(this).addClass('d-none');
});

//////////////////////////////////////////////////////////////////////////////////////
// New trick
//////////////////////////////////////////////////////////////////////////////////////
function SaveTrick()
{
    var id = $('.InputTrickName').attr('data-id');

    $.ajax({
        url: "/TrickNewSave/" + id,
        method:'POST',
        data: { name: $('.InputTrickName').val(), description: $('.InputTrickDesc').val(), group: $('.InputTrickGroup').val() }
    })
        .done(function( data )
        {

        });
}

$('.InputTrickName').keyup(function()
{
    if(window.location.pathname != '/index.php/TrickNew' && window.location.pathname != '/TrickNew')
        return;

    $('.FigureName').text($(this).val());

    SaveTrick();
});

$('.InputTrickDesc').keyup(function()
{
    if(window.location.pathname != '/index.php/TrickNew' && window.location.pathname != '/TrickNew')
        return;

    SaveTrick();
});

$('.InputTrickGroup').change(function()
{
    if(window.location.pathname != '/index.php/TrickNew' && window.location.pathname != '/TrickNew')
        return;

    SaveTrick();
});

//////////////////////////////////////////////////////////////////////////////////////
// Modal
//////////////////////////////////////////////////////////////////////////////////////
$('.ModalLinkConfirm').click(function()
{
    $('.ModalConfirmTitle').text($(this).attr('data-title'));
    $('.ModalConfirmContent').text($(this).attr('data-content'));
    $('.btnmodalconfirm').attr('href', $(this).attr('href'));
});

$('.ModalLinkAlert').click(function()
{
    $('.ModalAlertTitle').text($(this).attr('data-title'));
    $('.ModalAlertContent').text($(this).attr('data-content'));
});