@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @component('components.who')
                        
                    @endcomponent  

                   
                </div>
            </div>

            <div>
                <h2>Your Quizzes</h2>
                @if(isset($quizzes))
                    @foreach($quizzes as $quiz)
                    <div>
                        <div>{{ $quiz->quiz }}</div>
                        <a href="show-results/{{$quiz->id}}"><button class="btn btn-primary">See Latest Results</button></a>
                        <a href="edit-quiz/{{$quiz->id}}"><button class="btn btn-primary">Edit Quiz</button></a>
                        <form method="POST" action="/delete-quiz/{{$quiz->id}}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-primary" type="submit">Delete</button>
                        </form>
                    </div>
                    @endforeach
                @endif
                <h3>Create New Quiz</h3>
                <form action="/create-quiz" method="POST">
                     {{ csrf_field() }}
                    <div class="form-control">

                        <input type="text" name="quiz" id="" placeholder="New Quiz Name">
                        <button type="submit">Create</button>
                    </div>
                </form>
                
            </div>

        </div>
    </div>
</div>
@endsection
