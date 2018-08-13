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
                alert('Les derniers commentaires ont déjà été chargés');
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

        if(data.length == 0)
            alert('Les dernieres figures ont déjà été chargées');
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

$('.LinkDelTrick').click(function(e){
    if(!confirm("êtes vous sur de vouloir supprimer la figure ainsi que tout les commentaires et médias associés ?"))
        e.preventDefault();
});

$( document ).ready(function() {
    $('.alert').delay(3000).fadeOut(5000);

    $('.InputTrickName').each(function()
    {
        $('.FigureName').text($(this).val());
    });
});

$('.TrickEditBtn').click(function(){
    var id = $(this).attr('data-id');

    alert('edition du media : ' + id);
});

$('.TrickTrashBtn').click(function(){
    var id = $(this).attr('data-id');
    var parent = $(this);

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
                parent.closest('.FigureBox').remove();
            }
        });
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

console.log(window.location.pathname);

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