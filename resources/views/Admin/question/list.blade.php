<x-app-layout>
    <x-slot name="header">{{$quiz->title}}Quizine Ait Sorular</x-slot>

    <div class="card">
        <div class="card-boy">
{{--<h5 class="card-title">
                <a href="{{route('quizzes.index',$quiz->id)}}" class="btn btn-sm btn-secondary"><i class="fas fa-left-arrow"></i>QUİZLERE DÖN</a>
            </h5> --}}
            <h5 class="card-title float-right">
                <a href="{{route('question.create',$quiz->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>SORU OLUŞTUR</a>
            </h5>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">SORU</th>
                    <th scope="col">FOTOĞRAF</th>
                    <th scope="col">1.CEVAP</th>
                    <th scope="col">2.CEVAP</th>
                    <th scope="col">3.CEVAP</th>
                    <th scope="col">4.CEVAP</th>
                    <th scope="col">DOĞRU CEVAP</th>
                    <th scope="col" style="width: 70px">İŞLEMLER</th>
                </tr>

                @foreach($quiz->question as $questions)
                    <tr>
                        <td >{{$questions->question}}</td>
                        <td>{{$questions->image}}</td>
                        <td>{{$questions->answer1}}</td>
                        <td>{{$questions->answer2}}</td>
                        <td>{{$questions->answer3}}</td>
                        <td>{{$questions->answer4}}</td>
                        <td class="text-success">{{substr($questions->correct_answer,-1)}}.Cevap</td>
                     <td>

                            <a href="{{route('question.edit',[$quiz->id,$questions->id])}}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                            <a href="{{route('question.destroy',[$quiz->id,$questions->id])}}" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                @endforeach

                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
