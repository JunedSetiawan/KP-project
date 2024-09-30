<div class="student-list">
    @foreach($students as $student)
        <div class="student-item">
            <h3>{{ $student->name }}</h3>
            <p>{{ $student->gender }}</p>
            <p>{{ $student->classroom->name }}</p>
        </div>
    @endforeach
</div>