<template>
    <div class="container">
        <div class="row justify-content-center py-5">
            <div class="col-md-4">
                <h2 class="text-center mb-4">Todo List</h2>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" @keyup.enter="addTodo" v-model="text" placeholder="Type your next todo..">
                    <button class="btn btn-primary" type="button" @click="addTodo">Add</button>
                </div>
                <ul class="list-group">
                    <li class="list-group-item" v-for="todo in todos" :key="todo.id" >
                        <del v-if="todo.completed">{{ todo.text }}</del>
                        <span v-else>{{ todo.text }}</span>
                    </li>
                  </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getTodos();
        },
        data: function() {
            return {
                todos: [],
                text: ''
            }
        },
        methods: {
            getTodos: function() {
                fetch('/api/v1/todos')
                .then((response) => response.json())
                .then((json) => this.todos = json);
            },
            addTodo: function() {
                fetch('/api/v1/todos', {
                    method: 'POST',
                    body: JSON.stringify({
                        text: this.text
                    }),
                    headers: {
                    'Content-type': 'application/json; charset=UTF-8',
                    },
                })
                .then((response) => response.json())
                .then((json) => {
                    this.text = '';
                    this.getTodos();
                } );

            }
        }
    }
</script>
