<div class="course-item-admin">
    <!-- <img src="" alt=""> -->
    <h1>{{ $course->title }}</h1>
    <h3>{{ $course->excerpt }}</h3>
    <div class="button-group">
        <a class="button" href="courses/{{ $course->slug }}"> View </a>
        <a class="button" href="courses/{{ $course->slug }}/edit"> Edit </a>
        <a class="button" href="courses/{{ $course->slug }}/users"> Users </a>
        <div class="button-status-group">
            <form id="courseForm" method="post" action="courses/{{ $course->slug }}/publish-course">
                @csrf
                <br>Current status:</br>
                <select name="course-status" id="course-status" selected="WIP">
                    <option value=1>Publish</option>
                    @if ($course->hasPublication())
                        <option value=0>WIP</option>
                    @else
                        <option value=0 selected>WIP</option>
                    @endif
                </select>
                <button type="submit" class="button">Set</button>
            </form>

            <script>
                document.getElementById('courseForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission behavior

                // Get the selected value from the <select> element
                const selectedValue = document.getElementById('course-status').value;
                console.log(selectedValue);
                // Perform the AJAX POST request with the selected value
                // (rest of the AJAX code)
            });
            </script>
        </div>
    </div>
</div>