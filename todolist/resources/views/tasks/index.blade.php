@vite(['resources/css/app.css', 'resources/js/app.js'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List</title>
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-100 p-5">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold mb-4">ToDo List</h1>

        <!-- Formulaire pour ajouter une tâche -->
        <form method="POST" action="/tasks" class="mb-5">
            @csrf
            <input
                type="text"
                name="name"
                placeholder="Nouvelle tâche"
                class="border p-2 rounded w-full"
                required>
            <button class="bg-blue-500 text-white px-4 py-2 mt-2 rounded">Ajouter</button>
        </form>

        <!-- Liste des tâches -->
        <ul>
            @foreach ($tasks as $task)
                <li x-data="{ completed: {{ $task->is_completed ? 'true' : 'false' }} }" class="flex items-center mb-2">
                    <!-- Checkbox -->
                    <form method="POST" action="/tasks/{{ $task->id }}" x-on:change="$el.submit()">
                        @csrf
                        @method('PUT')
                        <input type="checkbox" name="is_completed" x-model="completed" class="mr-2">
                    </form>

                    <!-- Nom de la tâche -->
                    <span :class="{ 'line-through': completed }" class="flex-grow">{{ $task->name }}</span>

                    <!-- Bouton Supprimer -->
                    <form method="POST" action="/tasks/{{ $task->id }}">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500 ml-2">Supprimer</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
