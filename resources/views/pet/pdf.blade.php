<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$pet->name}}</title>
</head>
<style>
    @font-face{
        font-family: 'Open Sans';
        src:url({{asset('fonts/OpenSans-Regular.ttf')}});
        font-weight:normal;
    }
    body{
         font-family: 'Open Sans';
    }
div{
    margin: 10px;
    padding: 10px;
}
</style>
<body>
    <h1>{{$pet->species}}  {{$pet->name}}</h1>
     <div>  <b>Date of birth: </b>{{$pet->birth_date}}<div>
    <div ><b> Ownwer: </b>{{$pet->getOwner->name}} {{$pet->getOwner->surname}}
        <b>Phone number:</b> {{$pet->getOwner->contacts}}
    </div>
    <div > <b> Doctor: </b>{{$pet->getDoctor->name}} {{$pet->getDoctor->surname}}</div>
    <div><b>About:</b> {!!$pet->history!!} </div>
</body>
</html>