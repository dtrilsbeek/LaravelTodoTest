<style>
.todo-item {
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
.todo-item-delete {
    float: right;
    color: #3490dc;
    cursor: pointer;
}
.todo-item-body {
    padding: 15px;
}
</style>
<template>
    <div class="todo-item">
        <div class="todo-item-header">
            <div class="todo-item-title">
                {{ item.title }}
            </div>
            <div class="todo-item-delete">
                <span @click="$emit('delete-todo', item.id)">delete</span>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="todo-item-body">
            {{ item.body }}
        </div>
    </div>


</template>

<script>
    export default {
        props: ['item']
    }
</script>
