
<script src="https://cdn.tailwindcss.com"></script>
<body>

    <h1 class="text-5xl m-8 underline underline-offset-8">{{$title}}</h1>

    <ul class="m-8">
        @foreach($todos as $todo)
            <li class="border">
                <p class="font-bold">{{$todo->name}}</p>
                <p>{{$todo->description}}</p>
                <p>{{$todo->completed}}</p>
            </li>
            <br>
        @endforeach
    </ul>

</body>
