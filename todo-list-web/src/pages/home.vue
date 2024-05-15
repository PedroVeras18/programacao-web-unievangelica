<template>
  <div class="flex flex-col gap-7 text-slate-200">
    <div>
      <h1 class="text-2xl font-semibold text-center mt-6 leading-loose">Programação Web 2024/1</h1>
      <p>
        Projeto para disponibilizar atividades e trabalhos desenvolvidos durante a disciplina de
        programação web.
      </p>
    </div>
    <RouterLink
      class="bg-slate-500 rounded-md px-6 py-4 hover:brightness-110 transition-all"
      v-for="(card, index) in cards"
      :key="index"
      :to="card.href"
    >
      <h2 class="text-xl font-bold">{{ card.title }}</h2>
      <p class="text-gray-300">{{ card.description }}</p>
    </RouterLink>
  </div>
</template>
<script>
export default {
  data() {
    return {
      cards: [
        {
          href: '/pratica-01',
          title: 'Prática 01 - Ciclo 1 - Framework CSS',
          description: 'Atividade referente a Prática 01 - semana 05'
        },
        {
          href: '/todo-list',
          title: 'Todo list',
          description: 'Atividade referente a Prática 02 - semana 06'
        }
      ]
    }
  }
}
</script>
