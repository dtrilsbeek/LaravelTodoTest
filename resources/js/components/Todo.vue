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

        <todo-list>

        </todo-list>
    </div>
</template>

<script>
import TodoItem from "./TodoItem";
import TodoList from "./TodoList";

export default {
    components: {TodoList, TodoItem},
    data() {
        return {
            title: "",
            body: "",
            validationErrors: [],
        }
    },

    mounted() {

    },

    methods: {
        addTodo: function () {
            const data = {
                title: this.title,
                body: this.body
            }

            axios.post('/api/todo-items', data).then((response) => {
                this.items.push(response.data)
                this.$set(this, 'title', '');
                this.$set(this, 'body', '');
            }).catch(error => {
                if (error.response.status === 422) {
                    this.validationErrors = error.response.data.errors;
                }
            });
        },
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
.todo-select-user {
    float: right;

}
.todo-select-user:hover {
    color: #3490dc;
    cursor: pointer;
}
</style>
