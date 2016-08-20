@extends('layouts.app')

@section('content')
<div ng-controller="NavbarCtrl" class="navbar navbar-default navbar-static-top">
  <div class="navbar-header">
    <a class="navbar-brand" href="/"><i class="ion-ios7-pulse-strong"></i> Satellizer</a>
  </div>
  <ul class="nav navbar-nav">
    <li><a href="/#/">Home</a></li>
    <li ng-if="isAuthenticated()"><a href="/#/profile">Profile</a></li>
    <li ng-if="isAuthenticated()"><a href="/#/collage">Collage</a></li>
  </ul>
  <ul ng-if="!isAuthenticated()" class="nav navbar-nav pull-right">
    <li><a href="/#/login">Login</a></li>
    <li><a href="/#/signup">Sign up</a></li>
  </ul>
  <ul ng-if="isAuthenticated()" class="nav navbar-nav pull-right">
    <li><a href="/#/logout">Logout</a></li>
  </ul>
</div>

<div ui-view></div>
@endsection
