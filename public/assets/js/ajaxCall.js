function obtainBids($id) { // pass the auction id
    var route = Routing.generate('app_bidup');
    $.ajax({
        type: 'POST',
        url: route,
        data: ({ id: id }),
        async: true,
        dataType: "json",
        success: function(data) {
            console.log(data['bids']);
        }
    });
}