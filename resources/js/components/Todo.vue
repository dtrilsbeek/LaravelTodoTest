<style>
.card {
    margin-top: 10px;
}
.todo-add {
    float: right;
}
</style>
<template>

    <div class="card">
        <div class="card-header">Todo List

            <div class="todo-add">
                <input @keyup.enter="addTodo" v-model="body" type="text">
                <button v-on:click="addTodo">Add</button>
            </div>
        </div>

        <div class="card-body">

            <div class="row justify-content-center">
                <TodoItem
                    v-for="(item, key) in items"
                    :key="key"
                    v-bind:item="item"
                    v-on:delete-todo="deleteTodo">
                </TodoItem>
            </div>

        </div>
    </div>

</template>

<script>
import TodoItem from "./TodoItem";

export default {
    components: {TodoItem},
    data() {
        return {
            body: "",
            items: []
        }
    },

    mounted() {
        axios.get('/api/todo-items').then((response) => {
            console.log(response);
            this.items = response.data;
        })
    },

    methods: {
        addTodo: function () {
            if(this.body.length > 0) {
                const data = {
                    title: 'title',
                    body: this.body
                }

                console.log(data);

                axios.post('/api/todo-items', data).then((response) => {
                    console.log(response);

                    this.items.push(response.data)
                    this.body = "";
                });
            }
        },
        deleteTodo(todoId) {
            axios.delete(`/api/todo-items/${todoId}`).then((response) => {
                console.log(response)
                if (response.status === 204) {
                    this.items = this.items.filter(todo => todo.id !== todoId);
                }
            });
        }
    }
}
</script>
