<div class="course-item">
    <!-- <img src="" alt=""> -->
    <h1>{{ $publification->course->title }}</h1>
    <h3>{{ $publification->course->excerpt }}</h3>
    <!-- <br>{{ $publification->price }}</br> -->
    <div class="button-group">
        <a class="button" href="#"> Learn More </a>
        <form action="/courses" method="post">
            @csrf
            <button class="button" name="course" value={{ $publification->id }}>Add To Cart</button>
        </form>
    </div>
</div>