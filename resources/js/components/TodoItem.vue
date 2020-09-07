<template>
    <div class="todo-item">
        <div class="todo-item-header">
            <div class="todo-item-title">
                {{ item.title }}
            </div>
            <slot name="delete">
            </slot>
            <div class="clearfix"></div>
        </div>

        <div class="todo-item-body">{{ item.body }}</div>
        <div class="todo-item-user">
            {{ getUserName() }}
        </div>
    </div>


</template>

<script>
    export default {
        props: ['item'],

        methods: {
            getUserName: function() {
                if(this.item.user && this.item.user.name) {
                    return this.item.user.name;
                }
            }
        }
    }


</script>

<style>
.todo-item {
    position: relative;
    margin: 7px;
    border-radius: 10px;
    background-color: #636b6f;
    color: #FFFFFF;
}
.todo-item-header {
    border-radius: 10px 10px 0 0;
    background-color: #99d4d4;
    color: #636b6f;
    padding: 15px;
}
.todo-item-title {
    float: left;
    margin-right: 20px;
}
.todo-item-body {
    padding: 15px 15px 30px;
    white-space: pre-line;
}
.todo-item-user {
    padding: 10px 10px;
    position: absolute;
    color: #89898f;
    bottom: 0;
    right: 0;
}
</style>
