<x-app-layout>
    <x-slot name="header">QUİZLER</x-slot>

  <div class="card">
      <div class="card-boy">
          <h5 class="card-title float-right">
          <a href="{{route('quizzes.create')}}" class="btn btn-sm btn-primary">QUİZ OLUŞTUR</a>
          </h5>
          <form method="GET">
              <div class="form-row">
                  <div class="col-md-2">
                      <input type="text" name="title" value="{{request()->get('title')}}" placeholder="Quiz Adı" class="form-control">
                  </div>
                  <div class="col-md-2">
                      <select class="form-control" onchange="this.form.submit()" name="status">
                          <option>Durum Seçiniz</option>
                          <option @if(request()->get('status')=='publish') selected @endif value="publish">Aktif</option>
                          <option @if(request()->get('status')=='passive') selected @endif value="passive">Pasif</option>
                          <option @if(request()->get('status')=='draft') selected @endif value="draft">Taslak</option>
                      </select>
                  </div>
                  @if(request()->get('title')||request()->get('status'))
                  <div class="col-md-2">
                      <a href="{{route('quizzes.index')}}" class="btn btn-secondary">Sıfırla</a>
                  </div>
                  @endif
              </div>
          </form>
          <table class="table table-bordered">
              <thead>
              <tr>
                  <th scope="col">QUİZ</th>
                  <th scope="col">SORU SAYISI</th>
                  <th scope="col">DURUM</th>
                  <th scope="col">BİTİŞ TARİHİ</th>
                  <th scope="col">İŞLEM</th>
              </tr>
              </thead>
              <tbody>
               @foreach($quizzes as $quiz)
              <tr>
                  <th >{{$quiz->title}}</th>
                  <td>{{$quiz->question_count}}</td>
                  <td>
                      @switch($quiz->status)
                          @case('publish')
                          <span class="x-badge type=success">Aktif</span>
                          @break
                          @case('passive')
                          <span class="x-badge type=danger">Pasif</span>
                          @break
                          @case('draft')
                          <span class="x-badge type=warning">Taslak</span>
                          @break
                      @endswitch
                  </td>
                  <td>
                      <span title="{{$quiz->finished_at}}"> {{$quiz->finished_at ? $quiz->finished_at->diffForHumans() : '-'}}</span>
                  </td>
                  <td>
                      <a href="{{route('question.index',$quiz->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-question"></i></a>
                      <a href="{{route('quizzes.edit',$quiz->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                      <a href="{{route('quizzes.destroy',$quiz->id)}}" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></a>
                  </td>
              </tr>
               @endforeach
              </tbody>
          </table>
          {{$quizzes->withQueryString()->links()}}
      </div>
  </div>
</x-app-layout>
