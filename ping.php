<?php
/*
 *
 * Use the examples below to add your own servers. Coded by clone1018 [?]
 *
 */

$title = "Crossnetmeet"; // website's title
$servers = array(

    'Test to see if crossnet is down' => array(
        'ip' => 'google.com',
        'port' => 80,
        'info' => 'Hosted by Kenya Web Experts',
        'purpose' => 'Web Search'
    ),
    'An Example of a website that is down' => array(
        'ip' => 'example.com',
        'port' => 8091,
        'info' => 'Unknown',
        'purpose' => 'Demonstrate how it will look like if Crossnet is down'
    )

);

if (isset($_GET['host'])) {
    $host = $_GET['host'];


    if (isset($servers[$host])) {
        header('Content-Type: application/json');

        $return = array(
            'status' => test($servers[$host])
        );

        echo json_encode($return);
        exit;
    } else {
        header("HTTP/1.1 404 Not Found");
    }
}

$names = array();
foreach ($servers as $name => $info) {
    $names[$name] = md5($name);
}


?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootswatch/2.3.2/cosmo/bootstrap.min.css">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">
        <style type="text/css">
                /* Custom Styles */
                body{
                    background: linear-gradient(to right, rgb(62, 81, 81), rgb(222, 203, 164));
                    

                }
                .container{
                    text-align: center;
                    margin-top: 40px;
                }
                h2{
                    color: #8e0cc2;
                    float:right;
                    font-size: 36px;
                }
                h2 span{
                    color: #120024;
                }
                th{
                    
                    font-size: 22px;
                    margin: 30px 0px;
                    color: #fff;
                    background-color: #303a52;
                    height: 50px;
                    text-align: center;
                }
                table{
                    margin-top: 50px;
                }
                
                tr{
                    height: 45px;
                }
                tr:hover {background-color: #8e0cc2;}
                h2 span{
                    font-weight: bold;
                    color: #8e0cc2;
                }
                .img-logo{
                    height: 140px;
                    float: left;
                }
                .main-h2{
                    margin-top: 40px;
                }
                td, tr{
                    border: none;
                }

  
        </style>
    </head>
    <body>

        <div class="container">
         <a href="https://crossnetmeet.com/"> <img src="images/logo.jpeg" alt="" class="img-logo"></a>
          <h2 class= "main-h2">CrossNet <span>Meet</span></h2>
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Host</th>
                        <th>Purpose</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($servers as $name => $server): ?>

                        <tr id="<?php echo md5($name); ?>">
                            <td><i class="icon-spinner icon-spin icon-large"></i></td>
                            <td class="name"><?php echo $name; ?></td>
                            <td><?php echo $server['info']; ?></td>
                            <td><?php echo $server['purpose']; ?></td>
                        </tr>

                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript">

            function test(host, hash) {
                // Fork it
                var request;

                // fire off the request to /form.php
                request = $.ajax({
                    url: "<?php echo basename(__FILE__); ?>",
                    type: "get",
                    data: {
                        host: host
                    },
                    beforeSend: function () {
                        $('#' + hash).children().children().css({'visibility': 'visible'});
                    }
                });

                // callback handler that will be called on success
                request.done(function (response, textStatus, jqXHR) {
                    var status = response.status;
                    var statusClass;
                    if (status) {
                        statusClass = 'success';
                    } else {
                        statusClass = 'error';
                    }

                    $('#' + hash).removeClass('success error').addClass(statusClass);
                });

                // callback handler that will be called on failure
                request.fail(function (jqXHR, textStatus, errorThrown) {
                    // log the error to the console
                    console.error(
                        "The following error occured: " +
                            textStatus, errorThrown
                    );
                });


                request.always(function () {
                    $('#' + hash).children().children().css({'visibility': 'hidden'});
                })

            }

            $(document).ready(function () {

                var servers = <?php echo json_encode($names); ?>;
                var server, hash;

                for (var key in servers) {
                    server = key;
                    hash = servers[key];

                    test(server, hash);
                    (function loop(server, hash) {
                        setTimeout(function () {
                            test(server, hash);

                            loop(server, hash);
                        }, 6000);
                    })(server, hash);
                }

            });
        </script>

    </body>
</html>
<?php
/* Misc at the bottom */
function test($server) {
    $socket = @fsockopen($server['ip'], $server['port'], $errorNo, $errorStr, 3);
    if ($errorNo == 0) {
        return true;
    } else {
        return false;
    }
}

function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}

?>