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
       @if($planning)
       
           
       <table>
        <thead>
            <tr >
                <th colspan="8">Plan-1 {{$planning->client->client_name}}-{{$date}} </th>
            </tr>
            <tr>
                <th>Date & Time</th>
                <th>Detox Early Morning</th>
                <th>9.00-9.30</th>
                <th>11.00-11.30</th>
                <th>01.00-01.30pm</th>
                <th>4.00-4.30pm</th>
                <th>7.00-7.30pm</th>
                <th>9.00-9.30pm</th>
            </tr>
        </thead>
        <tbody>
            @if($remaining_days > 0)
            @for($index=0;$index<$remaining_days;$index++)
            <tr>
                <td style="width: 100px">Day {{$index+1}}</td>
            @foreach ($planning->plan_types as $plan_type)
                <td>{{$plan_type->food_details}}</td>
            @endforeach
            </tr>    
            @endfor
            @endif
        </tbody>
       </table>

       <h4>Objective:</h4>
       <p>{{$planning->objective}}</p>
       <h4>Notes:</h4>
       <p>{{$planning->comments}}</p>
  
       @endif

       <p><strong>GAYATHRI.S</strong>
<br>Executive director and Senior wellness coach
<br>M/S LIFEEZI HEALTH AND FITNESS SERVICES PRIVATE LIMITED</p>
<footer>
   For more information,please visit the website<a href="www.lifeezi.com" target="_blank" style="text-decoration: none"> Lifeezi</a>
</footer>

  
</body>
</html>