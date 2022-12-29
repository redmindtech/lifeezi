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
            border-collapse: collapse
         }
    </style>
</head>
<body>
    <div class="center">  <img src="{{$data['image']}}"   width="50" height="50" /></div>
    <h3 style="text-align: center;">LIFEEZI HEALTH AND FITNESS SERVICES PRIVATE LIMITED</h3>
   <br/>
   <table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Day of Observation</th>
            <th>Wake up Time</th>
            <th>BedTime</th>
            <th>Exercise Routine</th>
            <th>Steps</th>
            <th>Water Intake Litres</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['observations'] as $observation)
        <tr>
        <td>{{dateFormat($observation->date)}}</td>
        <td>{{$observation->day_of_observation}}</td>
        <td>{{$observation->wake_up_time}}</td>
        <td>{{$observation->bed_time}}</td>
        <td>{{$observation->exercise_routine}}</td>
        <td>{{$observation->steps}}</td>
        <td>{{$observation->water_intake}}</td>
        </tr>
        @endforeach
    </tbody>
   </table>
         <p><strong>GAYATHRI.S</strong>
<br>Executive director and Senior wellness coach
<br>M/S LIFEEZI HEALTH AND FITNESS SERVICES PRIVATE LIMITED</p>
<footer>
   For more information,please visit the website<a href="www.lifeezi.com" target="_blank" style="text-decoration: none"> Lifeezi</a>
</footer>
</body>
</html>