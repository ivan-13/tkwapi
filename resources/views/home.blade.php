<html>
    <head>
        <style>
            main{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width:100%;               
            }
            ul{
                width:60%;
            }
            li{
                padding:6px;
            }
        </style>
    </head>
    <body>
        <main>
            <h1>Hi!</h1> 
            <h2>Welcome to tkwapi</h2>
            <h3>Examples:</h3>                
            <ul>
                <li>GET /v1/restaurant => retrieve all restaurants sorted by open state desc, popularity desc and name asc</li>
                <li>GET /v1/restaurant?open=2 => retrieve all opened restaurants sorted by popularity desc</li>
                <li>GET /v1/restaurant?sort=-bestMatch => retrieve all restaurants sorted by open state desc and bestMatch desc</li>
                <li>GET /v1/restaurant?sort=bestMatch => retrieve all restaurants sorted by open state desc and bestMatch asc</li>
                <li>GET /v1/restaurant?sort=-ratingAverage&open=2 => retrieve all opened restaurants sorted by ratingAverage desc (high to low rating)</li>
                <li>GET /v1/restaurant?s=pizza&open=2&sort=averageProductPrice => retrieve all opened restaurants that contain "pizza" in the name sorted by averageProductPrice asc (low to high price)</li>
            </ul>
            <small>Powered by {{ $lumen }}</small>
        </main>
    </body>
</html>