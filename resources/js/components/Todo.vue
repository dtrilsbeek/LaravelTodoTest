<template>
    <div class="todo">
        <div class="card">
            <div class="card-header">Add Todo Item</div>

            <div class="card-body todo-add container">

                <ul style="list-style-type: none; padding: 0;">
                    <li v-for="(errors, key) in validationErrors" :key="key"
                        v-bind:error="errors" class="alert alert-danger">
                        <div v-for="message in errors" v-bind:message="message">
                            {{ message }}
                        </div>
                    </li>
                </ul>

                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
                    <div class="col-md-6">
                        <input id="title" v-model="title" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="body" class="col-md-4 col-form-label text-md-right">What needs to be done?</label>
                    <div class="col-md-6">
                        <textarea id="body"
                                  v-model="body" required="required" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button v-on:click="addTodo" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Todo List</div>

            <div class="card-body">

                <div class="row justify-content-center">
                    <TodoItem
                        v-for="(item, key) in items"
                        :key="key"
                        v-bind:item="item"
                    >
                        <template #delete>
                            <span class="todo-item-delete" @click="deleteTodo(item)">delete</span>
                        </template>
                    </TodoItem>
                </div>

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
            title: "",
            body: "",
            items: [],
            validationErrors: [],
        }
    },

    mounted() {
        // axios.get('/api/users/auth').then((response) => {
        //     console.log("auth: ",response);
        // });

        axios.get('/api/todo-items').then((response) => {
            console.log(response);
            this.$set(this, 'items', response.data);
        })
    },

    methods: {
        addTodo: function () {
            const data = {
                title: this.title,
                body: this.body
            }

            console.log(data);

            axios.post('/api/todo-items', data).then((response) => {
                console.log(response);

                this.items.push(response.data)
                this.$set(this, 'title', '');
                this.$set(this, 'body', '');
            }).catch(error => {
                if (error.response.status === 422) {
                    this.validationErrors = error.response.data.errors;
                }
            });
        },
        deleteTodo(item) {
            axios.delete(`/api/todo-items/${item.id}`).then((response) => {
                console.log(response)
                if (response.status === 204) {
                    this.$set(this, 'items', this.items.filter(todo => todo.id !== item.id));
                }
            });
        }
    }
}
</script>
<style>
.card {
    margin-top: 10px;
}

.todo-add {
    float: right;
}

.todo-item-delete {
    float: right;
    color: #3490dc;
    cursor: pointer;
}
</style>
