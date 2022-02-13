<x-app-layout>
    <x-slot name="header">QUİZ Düzenle</x-slot>

    <div class="card">
        <div class="card-boy">
            <form method="POST" action="{{route('quizzes.update',$quiz->id)}}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>Quiz Başlığı</label>
                    <input type="text" name="title" class="form-control" value="{{$quiz->title}}">
                </div>
                <div class="form-group">
                    <label>Quiz Açıklama</label>
                    <textarea name="description" class="form-control" rows="4" >{{$quiz->description}}</textarea>
                </div>
                <div class="form-group">
                    <label>Quiz Durum</label>
                    <select name="status" class="form-control">
                        <option @if($quiz->question_count<4) disabled @endif  @if($quiz->status==='publish')  selected @endif  value="publish">Aktif</option>
                        <option @if($quiz->status==='passive') selected @endif  value="passive">Pasif</option>
                        <option @if($quiz->status==='draft') selected @endif value="draft">Taslak</option>
                    </select>
                </div>
                <div class="form-group">
                    <input id="isFinish"  @if($quiz->finished_at) checked @endif type="checkbox">
                    <label>Bitiş Tarihi Olacak Mı?</label>

                </div>
                <div id="finishInput" @if(!$quiz->finished_at) style="display:none"@endif class="form-group">
                    <label>Bitiş Tarihi</label>
                    <input type="datetime-local" name="finished_at" @if($quiz->finished_at)value="{{date('Y-m-d\TH:i',strtotime($quiz->finished_at))}}@endif class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit"  class="btn btn-success btn-sm btn-block">Quiz Güncelle</button>
                </div>
            </form>
        </div>
    </div>
    <x-slot name="js">
        <script>
            $("#isFinish").change(function (){
                if($('#isFinish').is(':checked')){
                    $('#finishInput').show();
                }else{
                    $('#finishInput').hide();
                }
            })
        </script>
    </x-slot>
</x-app-layout>
