<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>
    Pusher.logToConsole = true;

    var pusher = new Pusher('d1a84316b9cf0243536a', {
        cluster: 'ap1',
        forceTLS: true
    });

    var channel = pusher.subscribe('my-chanal'); // must match broadcastOn()
    channel.bind('cloudtravel', function(data) { // must match broadcastAs()
   
        console.log(data);
    });
</script>
