<template>
    <div class="todo">
        <div class="card">
            <div class="card-header">
                <span>Todo List</span>

                <div class="todo-select-user">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-down-fill" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                    </svg>
                    <span v-on:click="selectUser()">Select User</span>
                    <ul>
                        <li v-for="user in users">{{ user }}</li>
                    </ul>
                </div>

            </div>

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
            selectedUserId: null,
            users: [],
            items: [],
        }
    },

    mounted() {
        axios.get('/api/todo-items').then((response) => {
            console.log(response);
            this.$set(this, 'items', response.data);
            this.$set(this, 'users', this.getUsersFromItems(this.items))
        })

        console.log(this.users);
    },

    methods: {
        deleteTodo(item) {
            axios.delete(`/api/todo-items/${item.id}`).then((response) => {
                console.log(response)
                if (response.status === 204) {
                    this.$set(this, 'items', this.items.filter(todo => todo.id !== item.id));
                }
            });
        },
        viewUsers() {

        },
        selectUser() {

        },

        getUserName: function (item) {
            if (item.user && item.user.name) {
                return item.user.name;
            }
        },

        getUsersFromItems(items) {
            let lookup = {};
            let result = [];

            for (const itemKey in items) {
                let item = items[itemKey];
                if (item.hasOwnProperty('user')) {
                    let name = item.user.name;

                    if (!(name in lookup)) {
                        lookup[name] = 1;
                        result.push(name);
                    }
                }
            }

            console.log(result);
            this.$set(this, 'users', result);
        },
    }
}
</script>
<style>
.card {
    margin-top: 10px;
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
