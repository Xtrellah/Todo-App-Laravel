
<body>

    <h1>{{$title}}</h1>

    <ul>
        @foreach($todos as $todo)
            <li>
                <h3>{{$todo->name}}</h3>
                <p>{{$todo->description}}</p>
            </li>
        @endforeach
    </ul>

</body>
