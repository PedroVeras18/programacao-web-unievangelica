<template>
  <div class="min-w-screen min-h-screen bg-slate-800">
    <nav class="text-slate-200">
      <RouterLink class="text-lg font-medium px-2 hover:underline" to="/">Home</RouterLink>
    </nav>
    <main class="w-full flex flex-col items-center">
      <RouterView />
    </main>
  </div>
</template>
