<x-app-layout>
    <x-slot name="header">{{$quiz->title}}</x-slot>
    <div class="card" >
        <div class="card-body">
            <p class="card-text">
                <form method="POST" action="{{route('quiz.result',$quiz->slug)}}">
                @csrf
                @foreach($quiz->question as $questions)
                   <strong>#{{$loop->iteration}} {{$questions->question}}</strong>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="{{$questions->id}}" id="quiz{{$questions->id}}1" value="answer1" required>
                <label class="form-check-label" for="quiz{{$questions->id}}1">
                   {{$questions->answer1}}
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="{{$questions->id}}" id="quiz{{$questions->id}}2" value="answer2" required>
                <label class="form-check-label" for="quiz{{$questions->id}}2">
                    {{$questions->answer2}}
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="{{$questions->id}}" id="quiz{{$questions->id}}3" value="answer3" required>
                <label class="form-check-label" for="quiz{{$questions->id}}3">
                    {{$questions->answer3}}
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="{{$questions->id}}" id="quiz{{$questions->id}}4" value="answer4" required>
                <label class="form-check-label" for="quiz{{$questions->id}}4">
                    {{$questions->answer4}}
                </label>
            </div>
            @if(!$loop->last)
                <hr>
                @endif
                @endforeach

                <button type="submit" class="btn btn-success btn-sm btn-block">Sınavı Bitir</button>
            </form>
            </p>

        </div>
    </div>

</x-app-layout>
