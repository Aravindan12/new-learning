<!DOCTYPE html>
<html>
<head>
    <title>Laravel Livewire CRUD</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    @livewireStyles
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Laravel Livewire CRUD</h2>
                        <a href="/return-back" style="float: right;"><button class="btn btn-primary">Return Back</button></a>
                    </div>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        @livewire('books')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
</body>
</html>