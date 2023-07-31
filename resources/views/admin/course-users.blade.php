<x-admin-layout>
    <x-slot name="header">
        {{ $course->title }}
    </x-slot>

    <div class="container">
        <a href="/users/search">right url?</a>
        <table>
            <tr>
                <th>Id</th>
                <th>name</th>
                <th>email</th>
            </tr>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
            </tr>
            @endforeach
        </table>
        <form id="searchForm">
            @csrf
            <br>Add user</br>
            <input type="text" placeholder="Search.." name="users-query" id="usersQuery">
            <button type="submit" class="button">Search</button>
        </form>

        <div id="searchResults">
            <!-- The search results will be displayed here -->
        </div>

        @push('js-stack')
            <script>
            // Function to perform the search
            function performSearch(query) {
                fetch(`/users/search?users-query=${encodeURIComponent(query)}`, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Replace with the actual CSRF token if needed
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const searchResultsDiv = document.getElementById('searchResults');
                    searchResultsDiv.innerHTML = ''; // Clear any previous results

                    if (data.length === 0) {
                        searchResultsDiv.innerHTML = 'No users found.';
                    } else {
                        data.forEach(user => {
                            searchResultsDiv.innerHTML += 
                            `<div>
                                <p>${user.name}</p>
                                <button class="button" onclick="performPost(${user.id})">Add user</button>
                            </div>`;
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching search results:', error);
                });
            }

            function performPost(userId) {
                fetch(`./users/add/`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Replace with the actual CSRF token if needed
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ user_id: userId }) // Pass user ID as JSON data
                })
                .then(response => response.json())
                .then(data => {
                    // Handle the POST response if needed
                    console.log('POST response:', data);
                })
                .catch(error => {
                    console.error('Error performing POST request:', error);
                });
            }       

            // Add an event listener to the input field to handle live search
            document.getElementById('usersQuery').addEventListener('input', function(event) {
                const query = event.target.value;
                performSearch(query);
            });
            </script>
        @endpush
    </div>
</x-admin-layout>