<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
          <style>
         img{
            margin-left: 300px;
         }
         p{
            line-height: 1.5rem;
         }

         table,th,td{
            border:1px solid #000;
            border-collapse: collapse;
         }
         table{
            width:100%;
         }
        </style>
</head>
<body>
          <div class="center">  <img src="{{$image}}"   width="50" height="50" /></div>
       <h3 style="text-align: center;">LIFEEZI HEALTH AND FITNESS SERVICES PRIVATE LIMITED</h3>
       <h4 style="text-align: center;text-decoration:underline">{{($client->sex == 'male' ? 'Mr.':'Mrs.') . $client->client_name}}</h4>
       <h4 style="text-align: center;text-decoration:underline">Review after {{$remaining_days}} days of the process</h4>
       <h5 style="text-decoration:underline">Client's Proress:</h5>
       <br/>
       <p>{{$review->client_progress}}</p>
       <br/>
       <h5 style="text-decoration:underline">Clients concerns:</h5>
       <br/>
       <p>{{$review->client_concern}}</p>
       <h2 style="text-decoration: underline">Areas to focus and improve</h2>
       <br>
       <p>{{$review->area_need_to_focus}}</p>

<br/>
<p>Please keep up the sincere efforts and ensure recommended walking every day.</p>
<br/>

   

       <p><strong>GAYATHRI.S</strong>
<br>Executive director and Senior wellness coach
<br>M/S LIFEEZI HEALTH AND FITNESS SERVICES PRIVATE LIMITED</p>
<footer>
   For more information,please visit the website<a href="www.lifeezi.com" target="_blank" style="text-decoration: none"> Lifeezi</a>
</footer>

  
</body>
</html>