$( ".LoadMoreComment" ).click(function(e) {
    e.preventDefault();

    var index = parseInt($(this).attr('data-index'));
    var newindex = index + parseInt($(this).attr('data-baseindex'));
    var parent = $(this);

    $.ajax({
        url: "/FigureCom/" + $(this).attr('data-id') + "/" + index,
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
        url: "/FigureLoad/" + index,
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