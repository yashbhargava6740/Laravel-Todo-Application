<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Todos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .todo-card { background: #fff; border-radius: 10px; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    .avatar { width: 30px; height: 30px; border-radius: 50%; object-fit: cover; }
  </style>
</head>
<body>
<div class="container py-5">
  <div class="todo-card mx-auto" style="max-width: 700px;">
    <div class="form-check mb-3">
      <input class="form-check-input" type="checkbox" id="showAllTasks" checked>
      <label class="form-check-label fw-bold" for="showAllTasks">Show All Tasks</label>
    </div>

    <!-- Input group -->
    <div class="row g-2 mb-3">
      <div class="col-md-4">
        <input type="text" id="newTodoTitle" class="form-control" placeholder="Title">
      </div>
      <div class="col-md-4">
        <input type="text" id="newTodoBody" class="form-control" placeholder="Description">
      </div>
      <div class="col-md-3">
        <input type="text" id="newTodoImage" class="form-control" placeholder="Image URL">
      </div>
      <div class="col-md-1 d-grid">
        <button class="btn btn-success" onclick="addTodo()">Add</button>
      </div>
    </div>

    <div id="taskList"></div>
  </div>
</div>

<!-- <script>
  const taskList = document.getElementById('taskList');

  function timeAgo(date) {
        const now = new Date();
        const diff = (now - date) / 1000; // in seconds

        if (diff < 60) return 'just now';
        if (diff < 3600) return `${Math.floor(diff / 60)} minute${Math.floor(diff / 60) > 1 ? 's' : ''} ago`;
        if (diff < 86400) return `${Math.floor(diff / 3600)} hour${Math.floor(diff / 3600) > 1 ? 's' : ''} ago`;
        if (diff < 604800) return `${Math.floor(diff / 86400)} day${Math.floor(diff / 86400) > 1 ? 's' : ''} ago`;
        if (diff < 2592000) return `${Math.floor(diff / 604800)} week${Math.floor(diff / 604800) > 1 ? 's' : ''} ago`;
        if (diff < 31536000) return `${Math.floor(diff / 2592000)} month${Math.floor(diff / 2592000) > 1 ? 's' : ''} ago`;
        return `${Math.floor(diff / 31536000)} year${Math.floor(diff / 31536000) > 1 ? 's' : ''} ago`;
    }


  async function fetchTodos() {
    const res = await fetch('/getTodos');
    const todos = await res.json();
    renderTodos(todos);
  }

  function renderTodos(todos) {
  taskList.innerHTML = '';
  todos.forEach(todo => {
    taskList.innerHTML += `
      <div class="d-flex align-items-center justify-content-between border-bottom py-3">
        <div class="form-check d-flex align-items-start gap-2 flex-grow-1">
          <input 
            class="form-check-input mt-1" 
            type="checkbox"
            onchange="toggleTodo(this)"
            data-id="${todo.id}"
            data-title="${todo.title}"
            data-body="${todo.body ?? ''}"
            data-image_url="${todo.image_url ?? ''}"
            ${todo.completed ? 'checked' : ''}>
          <div>
            <div class="fw-semibold">${todo.title}</div>
            <small class="text-muted">${todo.body ?? ''}</small><br>
            <small class="text-muted">${timeAgo(new Date(todo.created_at))}</small>
          </div>
        </div>
        <div class="d-flex align-items-center gap-2">
          <img src="${todo.image_url ?? `https://i.pravatar.cc/30?u=${todo.id}`}" class="avatar" />
          <button class="btn btn-sm btn-outline-secondary" onclick="deleteTodo(${todo.id})">
            <i class="bi bi-trash"></i>
          </button>
        </div>
      </div>`;
  });
}


  async function addTodo() {
    const title = document.getElementById('newTodoTitle').value.trim();
    const body = document.getElementById('newTodoBody').value.trim();
    const image_url = document.getElementById('newTodoImage').value.trim();

    if (!title) return alert('Title is required');

    const res = await fetch('/createTodo', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({ title, body, image_url })
    });

    if (res.ok) {
      document.getElementById('newTodoTitle').value = '';
      document.getElementById('newTodoBody').value = '';
      document.getElementById('newTodoImage').value = '';
      fetchTodos();
    }
  }

  async function toggleTodo(checkbox) {
  const id = checkbox.dataset.id;
  const title = checkbox.dataset.title;
  const body = checkbox.dataset.body;
  const image_url = checkbox.dataset.image_url;
  const completed = checkbox.checked;

  await fetch(`/updateTodo/${id}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({ title, body, image_url, completed })
  });

  fetchTodos();
}


  async function deleteTodo(id) {
    await fetch(`/deleteTodo/${id}`, {
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    });
    fetchTodos();
  }

  document.addEventListener('DOMContentLoaded', fetchTodos);
</script> -->


<script>
  const taskList = document.getElementById('taskList');
  const showAllCheckbox = document.getElementById('showAllTasks');

  function timeAgo(date) {
    const now = new Date();
    const diff = (now - date) / 1000;

    if (diff < 60) return 'just now';
    if (diff < 3600) return `${Math.floor(diff / 60)} minute${Math.floor(diff / 60) > 1 ? 's' : ''} ago`;
    if (diff < 86400) return `${Math.floor(diff / 3600)} hour${Math.floor(diff / 3600) > 1 ? 's' : ''} ago`;
    if (diff < 604800) return `${Math.floor(diff / 86400)} day${Math.floor(diff / 86400) > 1 ? 's' : ''} ago`;
    if (diff < 2592000) return `${Math.floor(diff / 604800)} week${Math.floor(diff / 604800) > 1 ? 's' : ''} ago`;
    if (diff < 31536000) return `${Math.floor(diff / 2592000)} month${Math.floor(diff / 2592000) > 1 ? 's' : ''} ago`;
    return `${Math.floor(diff / 31536000)} year${Math.floor(diff / 31536000) > 1 ? 's' : ''} ago`;
  }

  async function fetchTodos() {
    const res = await fetch('/getTodos');
    let todos = await res.json();

    // Filter if "Show All Tasks" is unchecked
    if (!showAllCheckbox.checked) {
      todos = todos.filter(todo => !todo.completed);
    }

    renderTodos(todos);
  }

  function renderTodos(todos) {
    taskList.innerHTML = '';
    todos.forEach(todo => {
      taskList.innerHTML += `
        <div class="d-flex align-items-center justify-content-between border-bottom py-3">
          <div class="form-check d-flex align-items-start gap-2 flex-grow-1">
            <input 
              class="form-check-input mt-1" 
              type="checkbox"
              onchange="toggleTodo(this)"
              data-id="${todo.id}"
              data-title="${todo.title}"
              data-body="${todo.body ?? ''}"
              data-image_url="${todo.image_url ?? ''}"
              ${todo.completed ? 'checked' : ''}>
            <div>
              <div class="fw-semibold">${todo.title}</div>
              <small class="text-muted">${todo.body ?? ''}</small><br>
              <small class="text-muted">${timeAgo(new Date(todo.created_at))}</small>
            </div>
          </div>
          <div class="d-flex align-items-center gap-2">
            <img src="${todo.image_url ?? `https://i.pravatar.cc/30?u=${todo.id}`}" class="avatar" />
            <button class="btn btn-sm btn-outline-secondary" onclick="deleteTodo(${todo.id})">
              <i class="bi bi-trash"></i>
            </button>
          </div>
        </div>`;
    });
  }

  async function addTodo() {
    const title = document.getElementById('newTodoTitle').value.trim();
    const body = document.getElementById('newTodoBody').value.trim();
    const image_url = document.getElementById('newTodoImage').value.trim();

    if (!title) return alert('Title is required');

    const res = await fetch('/createTodo', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({ title, body, image_url })
    });

    if (res.ok) {
      document.getElementById('newTodoTitle').value = '';
      document.getElementById('newTodoBody').value = '';
      document.getElementById('newTodoImage').value = '';
      fetchTodos();
    }
  }

  async function toggleTodo(checkbox) {
    const id = checkbox.dataset.id;
    const title = checkbox.dataset.title;
    const body = checkbox.dataset.body;
    const image_url = checkbox.dataset.image_url;
    const completed = checkbox.checked;

    await fetch(`/updateTodo/${id}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({ title, body, image_url, completed })
    });

    fetchTodos();
  }

  async function deleteTodo(id) {
    await fetch(`/deleteTodo/${id}`, {
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    });
    fetchTodos();
  }

  showAllCheckbox.addEventListener('change', fetchTodos);
  document.addEventListener('DOMContentLoaded', fetchTodos);
</script>

</body>
</html>
