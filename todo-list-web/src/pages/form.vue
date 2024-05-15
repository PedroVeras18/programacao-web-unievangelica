<template>
  <form class="bg-slate-200 px-4 py-6 rounded-lg w-[400px] flex flex-col gap-4" action="">
    <h1 class="text-2xl font-bold text-center">Cadastro</h1>
    <div class="flex flex-col gap-2">
      <div class="flex flex-col gap-1">
        <label class="text-lg" for="name">Nome</label>
        <input
          class="px-4 py-2 rounded-md focus:outline-[2px] focus:outline-slate-500"
          type="text"
          id="name"
          placeholder="Nome exemplo"
        />
      </div>
      <div class="flex flex-col gap-1">
        <label class="text-lg" for="phone">Telefone</label>
        <input
          class="px-4 py-2 rounded-md focus:outline-[2px] focus:outline-slate-500"
          type="text"
          id="phone"
          placeholder="(00) 0000-0000"
        />
      </div>
      <div class="flex flex-col gap-1">
        <label class="text-lg" for="password">Senha</label>
        <input
          class="px-4 py-2 rounded-md focus:outline-[2px] focus:outline-slate-500"
          type="password"
          id="password"
          placeholder="•••••••••••"
        />
      </div>
      <div class="flex flex-col gap-1">
        <label class="text-lg" for="confirm-password">Confimar Senha</label>
        <input
          class="px-4 py-2 rounded-md focus:outline-[2px] focus:outline-slate-500"
          type="password"
          id="confirm-password"
          placeholder="•••••••••••"
        />
      </div>
    </div>
    <button
      class="py-2 rounded-md bg-slate-800 text-slate-200 text-xl font-bold hover:opacity-80 transition-all focus:outline-[2px] focus:outline-slate-50"
    >
      Confirmar
    </button>
  </form>
</template>
