<x-app-layout>
    <x-slot name="header">{{$quiz->title}}</x-slot>
    <div class="card" >
        <div class="card-body">
            <p class="card-text">
                <div class="row">
                <div class="col-md-4">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Puan
                            <span  class="">{{$quiz->my_result->point ?? ''}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Doğru /Yanlış Sayısı
                            <span  class="">{{$quiz->my_result->correct ?? ''}} doğru /{{$quiz->my_result->wrong ?? ''}} yanlış</span>
                        </li>

                        @if($quiz->finished_at)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Son Katılım Tarihi
                            <span title="{{$quiz->finished_at}}" class="">{{$quiz->finished_at->diffForHumans()}}</span>
                        </li>
                        @endif
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Soru Sayısı
                            <span class="">{{$quiz->question_count}}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                           Katılımcı Sayısı
                            <span class="">14</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                           Ortalama Puan
                            <span class="">60</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Morbi leo risus
                            <span class="">1</span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-8">

                    {{$quiz->description}}</p>
                    <a href="{{route('quiz.join',$quiz->slug)}}" class="btn btn-primary">Quiz'e Katıl</a>
                </div>
            </div>


        </div>
    </div>

</x-app-layout>
