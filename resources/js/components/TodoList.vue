<template>
    <div class="todo">
        <div class="card">
            <div class="card-header">
                <span>Todo List</span>

                <div class="todo-select-user-button" v-on:click="toggleVisibilityUserSelect()">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-down-fill" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                    </svg>
                    <span>Select User</span>
                </div>

                <ul class="todo-user-select-list"
                    ref="selectUser"
                    v-show="isVisibleUserSelect"
                    @focusout="handleFocusOut"
                    tabindex="0">
                    <li v-for="user in users"
                        @click="selectUser(user)"
                    >{{ user.name }}</li>
                </ul>

            </div>

            <div class="card-body">

                <div class="row justify-content-center">
                    <TodoItem
                        v-for="(item, key) in getItems()"
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
            isVisibleUserSelect: false,
            selectedUser: null,
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
        handleFocusOut() {
            this.$set(this, 'isVisibleUserSelect', false)
        },
        selectUser(user) {
            console.log(user);
            this.$set(this, 'selectedUser', user);
        },
        toggleVisibilityUserSelect: function () {
            this.$set(this, 'isVisibleUserSelect', true);

            setTimeout(() =>
                this.$refs.selectUser.focus()
            , 10);
        },

        getUserName: function (item) {
            if (item.user && item.user.name) {
                return item.user.name;
            }
        },

        getItems: function () {
            if (this.selectedUser && this.selectedUser.id) {
                const userId = this.selectedUser.id;

                return this.items.filter(todo => {
                    if (todo.user && todo.user.id) {
                        return todo.user.id === userId;
                    }
                    return false;
                })
            }

            return this.items;
        },

        getUsersFromItems(items) {
            let lookup = {};
            let result = [];

            for (const itemKey in items) {
                let item = items[itemKey];
                if (item.hasOwnProperty('user')) {
                    let name = item.user.id;

                    if (!(name in lookup)) {
                        lookup[name] = 1;
                        result.push(item.user);
                    }
                }
            }

            console.log(result);
            return result;
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

.todo-select-user-button {
    float: right;
}
.todo-select-user-button:hover {
    color: #3490dc;
    cursor: pointer;
}
.todo-user-select-list {
    position: absolute;
    right: 20px;
    top: 40px;
    z-index: 99;
    padding: 5px 10px 5px 20px;
    background-color: #f8fafc;
    border-radius: 5px;
    border: 1px solid #636b6f;
}
.todo-user-select-list li {
    list-style-type: none;
}
.todo-user-select-list li:hover {
    list-style-type: disc;
    color: #3490dc;
    cursor: pointer;
}
</style>
