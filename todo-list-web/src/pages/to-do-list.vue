<template>
  <!-- Container principal -->
  <div class="max-w-[600px] w-full mt-14 flex flex-col gap-4 px-4">
    <!-- Título da lista de tarefas -->
    <h1 class="text-3xl text-slate-200 font-bold text-center">Todo list</h1>
    <!-- Formulário para adicionar uma nova tarefa -->
    <form class="flex flex-1 gap-2" @submit.prevent="addTask">
      <input
        v-model="newTask"
        class="flex-1 rounded-md bg-slate-300 h-11 pl-4 font-medium placeholder:text-slate-500"
        type="text"
        placeholder="Nova tarefa"
      />
      <!-- Botão para adicionar uma nova tarefa -->
      <button
        type="submit"
        class="bg-sky-800 flex justify-center rounded-md items-center text-slate-100 basis-16"
        title="Add task"
      >
        <!-- Ícone de sinal de adição -->
        <ph-plus-circle size="1.5rem" />
      </button>
    </form>

    <!-- Lista de tarefas -->
    <div class="max-w-[600px] w-full flex flex-col gap-2">
      <!-- Iteração sobre as tarefas -->
      <div
        v-for="(task, index) in tasks"
        :key="index"
        class="bg-slate-600 px-2 py-4 flex items-center gap-2 rounded-md"
      >
        <!-- Componente de checkbox -->
        <CheckBox :checked="task.completed" @update:checked="completeTask(index)" />
        <!-- Nome da tarefa -->
        <span :class="{ 'line-through': task.completed }" class="text-white flex-1">{{
          task.name
        }}</span>
        <!-- Botão para remover a tarefa -->
        <button class="text-slate-300 hover:text-red-500 transition-all" @click="removeTask(index)">
          <!-- Ícone de lixeira -->
          <ph-trash size="1.2rem" />
        </button>
      </div>
    </div>

    <!-- Mensagem exibida quando não há tarefas cadastradas -->
    <div
      v-if="tasks.length === 0"
      class="max-w-[600px] h-[300px] w-full flex flex-col justify-center items-center font-semibold text-slate-500"
    >
      <ph-clipboard size="6rem" />
      <p class="font-semibold">Nenhuma tarefa cadastrada</p>
    </div>
  </div>
</template>

<script>
// Importando o componente CheckBox
import CheckBox from '../components/check-box.vue'

export default {
  components: {
    CheckBox
  },
  // Dados do componente
  data() {
    return {
      newTask: '', // Nova tarefa a ser adicionada
      tasks: [] // Lista de tarefas
    }
  },
  // Método executado após o componente ser montado
  mounted() {
    this.loadTasksFromLocalStorage() // Carrega as tarefas salvas no armazenamento local
  },
  // Métodos do componente
  methods: {
    // Adiciona uma nova tarefa à lista
    addTask() {
      if (this.newTask.trim() !== '') {
        this.tasks.push({ name: this.newTask, completed: false })
        this.saveTasksToLocalStorage() // Salva as tarefas no armazenamento local
        this.newTask = '' // Limpa o campo de nova tarefa
      }
    },
    // Remove uma tarefa da lista
    removeTask(index) {
      this.tasks.splice(index, 1)
      this.saveTasksToLocalStorage() // Salva as tarefas no armazenamento local
    },
    // Completa ou descompleta uma tarefa
    completeTask(index) {
      this.tasks[index].completed = !this.tasks[index].completed
      this.saveTasksToLocalStorage() // Salva as tarefas no armazenamento local
    },
    // Salva as tarefas no armazenamento local
    saveTasksToLocalStorage() {
      localStorage.setItem('tasks', JSON.stringify(this.tasks))
    },
    // Carrega as tarefas do armazenamento local
    loadTasksFromLocalStorage() {
      const savedTasks = localStorage.getItem('tasks')
      if (savedTasks) {
        this.tasks = JSON.parse(savedTasks)
      }
    }
  }
}
</script>
