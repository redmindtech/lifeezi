<!DOCTYPE html>
<html>
    <head>
        <style>
         img{
            margin-left: 300px;
         }
         p{
            line-height: 1.5rem;
         }
        </style>
    </head>
    <body>
      <div class="center">  <img src="{{$image}}"   width="50" height="50" /></div>
       <h3 style="text-align: center;">LIFEEZI HEALTH AND FITNESS SERVICES PRIVATE LIMITED</h3>
<br/>
<h4><b>Dear {{$title}}, </b></h4>
<p>Noted your communication regarding temporary discontinuation      from the program from
{{$date}} till {{dateFormat($disengagement->end_date)}}</p>
<p>Please make a note of the below:</p>
<p>1. This program is incomplete as you haven't achieved your objectives.</p>
<p>2. If you want to come back, you will have to undergo assessment again and
you will be treated as new joinee. Fees might vary depending on your
objectives at that time.</p>
<p>3. During this break from your side, we will not be responsible for any variation
in your weight or health condition. </p>
<p>Kindly acknowledge the receipt of the communication.</p>
<p>Take good care of yourself.</p>
<p>Thanks and best regards,</p> 

<p><strong>GAYATHRI.S</strong>
<br>Executive director and Senior wellness coach
<br>M/S LIFEEZI HEALTH AND FITNESS SERVICES PRIVATE LIMITED</p>
<footer>
   For more information,please visit the website<a href="www.lifeezi.com" target="_blank" style="text-decoration: none"> Lifeezi</a>
</footer>
    </body>
</html>

