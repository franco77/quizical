@extends('layouts.app')

@section('content')

<div class="col-md-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div>Teacher Dashboard</div>
        </div>
        <div class="dashboard-container">                
            <h3>Welcome {{ Auth::user()->name }}</h3>
            @component('components.messages')
                    
            @endcomponent
            <a class="btn btn-primary" role="button" href="{{ route('admin.changeUserDetailsForm') }}">Update Account</a>
            <a class="btn btn-secondary" role="button" href="{{ route('admin.changePasswordForm') }}">Change Password</a>
            <a class="btn btn-logout" role="button" href="{{ route('admin.logout') }}">Logout</a>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div>Create New Quiz</div>
        </div>
        <div class="dashboard-container">
            <form action="{{ route('quiz.create') }}" method="POST">
                {{ csrf_field() }}
                <div class="new-quiz-container">
                    <div>
                        <input type="text" name="quiz" placeholder="New Quiz Name" required>
                        <select name="category" required>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject[0] }}">{{ $subject[0] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form> 
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div>Your Quizzes</div>
        </div>
        <div class="dashboard-container">
            @if(isset($quizzes))
                @foreach($quizzes as $quiz)
                    <div class="admin-quiz-list">
                        <div class="admin-quiz-title {{ $quiz->category }}">
                            @foreach ($subjects as $subject)
                                @if ($subject[0] === $quiz->category)
                                    <i class="category-icon fa fa-{{ $subject[1] }}" aria-hidden="true"></i>
                                @endif                              
                            @endforeach
                            {{ $quiz->quiz }}
                        </div>
                        <div class="admin-quiz-list-btns">
                            <form method="POST" action="{{ route('quiz.showResults', ['id' => $quiz->id]) }}">
                                {{ csrf_field() }}
                                <div>
                                    <div>
                                        <label for="time">Display Results from:</label>
                                        <select name="time" required>
                                            <option value="60">Last Hour</option>
                                            <option value="1440">Today</option>
                                            <option value="10080">This Week</option>
                                            <option value="302400">This Month</option>
                                            <option value="300000000">All Time</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-primary" type="submit">See Results</button>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('quiz.presentResults', ['id' => $quiz->id]) }}">
                                {{ csrf_field() }}
                                <div>
                                    <div>
                                        <label for="time">Present Results from:</label>
                                        <select name="time" required>
                                            <option value="60">Last Hour</option>
                                            <option value="1440">Today</option>
                                            <option value="10080">This Week</option>
                                            <option value="302400">This Month</option>
                                            <option value="300000000">All Time</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Present Results</button>
                                </div>
                            </form>
                            <div class="admin-list-btn-container">
                                <a class="btn btn-primary" role="button" href="{{ route('quiz.editForm', ['id' => $quiz->id]) }}">Edit Quiz</a>
                                <form method="POST" action="{{ route('quiz.delete', ['id' => $quiz->id]) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-logout" type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif                
        </div>
    </div>
</div>

@endsection
