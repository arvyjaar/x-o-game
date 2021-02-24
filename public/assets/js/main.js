$(function () {
    let service = {
        callApi: function (board) {
            let playerUnit = "x";
            $.ajax({
                url: "game",
                method: "POST",
                data: JSON.stringify({
                    board: board,
                }),
                processData: false,
                contentType: "application/json",
            }).done(function (data) {
                if (!$.isEmptyObject(data.winner)) {
                    if (data.winner == playerUnit) {
                        service.finish(
                            "alert-success",
                            "The game is won!"
                        );
                        return;
                    } else {
                        service.finish("alert-danger", "The game is lost");
                        service.markBotMove(
                            data.botMove.x,
                            data.botMove.y,
                            data.botMove.unit
                        );
                        return;
                    }
                }

                if (data.draw) {
                    service.finish("alert-info", "It is is draw...");
                }

                service.markBotMove(
                    data.botMove.x,
                    data.botMove.y,
                    data.botMove.unit
                );
            }).fail(function(xhr){
                service.finish("alert-danger", "Oops! An Error Occurred. Status code: " + xhr.status);
            });
        },
        finish: function (alertClass, message) {
            $("#winner").addClass(alertClass).html(message);
            $("table").data("finished", true);
        },
        markBotMove: function (x, y, unit) {
            let tableElement = $("td")
                .filter("[data-x=" + x + "]")
                .filter("[data-y=" + y + "]");
            tableElement.data("unit", unit);
            tableElement.html("<i class='fa fa-circle-o fa-5x'></i>");
        },
    };

    $("td").on("click", function () {
        if ($(this).data("unit") !== "" || $("table").data("finished")) {
            return false;
        }

        $(this).html("<i class='fa fa-times fa-5x'></i>");
        $(this).data("unit", "x");

        let board = [];
        $(".table-row").each(function () {
            let row = [];
            $(this)
                .find("td")
                .each(function () {
                    row.push($(this).data("unit"));
                });
            board.push(row);
        });
        service.callApi(board);
    });

    $(".reset").on("click", function () {
        $("td").each(function () {
            $(this).data("unit", "");
            $(this).html("");
            $("#winner")
                .removeClass(function (index, className) {
                    return (className.match(/(^|\s)alert-\S+/g) || []).join(" ");
                })
                .html("");
        });
        $("table").data("finished", false);
    });
});
