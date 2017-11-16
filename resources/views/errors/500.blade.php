@extends('layouts.master')

@section('content')
    <div class="container">
        <!-- Jumbotron -->
        <div class="jumbotron">
            <h1><span class="glyphicon glyphicon-fire red"></span> 500 Internal Server Error</h1>
            <p class="lead">Something went wrong with your last request.</p>
            <a href="javascript:document.location.reload(true);" class="btn btn-default btn-lg text-center"><span class="green">Reload and try this page again</span></a>
        </div>
    </div>
    <div class="container">
        <div class="body-content">
            <div class="row">
                <div class="col-md-6">
                    <h2>What happened?</h2>
                    <p class="lead">A 500 error status implies there is a problem with the web server's software causing it to malfunction.</p>
                </div>
                <div class="col-md-6">
                    <h2>What can I do?</h2>
                    <p class="lead">If you're a site visitor</p>
                    <p> Not too much at the moment. As we are still in development we probably just haven't finished building this feature yet, but please feel free to let us know about this issue via our <a href="/tickets" class="btn btn-default btn-lg text-center"><span class="green">Help and Support page</span></a>. If you need immediate assistance, please send us an email instead. We apologize for any inconvenience.</p>
                </div>
            </div>
        </div>
    </div>
@endsection