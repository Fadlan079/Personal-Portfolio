document.addEventListener('DOMContentLoaded', () => {

    const openBtn = document.getElementById('openCreateModal')
    const modal = document.getElementById('createProjectModal')
    const closeBtn = document.getElementById('closeCreateModal')
    const cancelBtn = document.getElementById('cancelCreateModal')

    if (!openBtn || !modal) return

    // OPEN MODAL
    openBtn.addEventListener('click', () => {
        modal.classList.remove('hidden')
        modal.classList.add('flex')
        document.body.classList.add('overflow-hidden') // disable scroll
    })

    // CLOSE FUNCTION
    const closeModal = () => {
        modal.classList.add('hidden')
        modal.classList.remove('flex')
        document.body.classList.remove('overflow-hidden')
    }

    // CLOSE BUTTON
    closeBtn?.addEventListener('click', closeModal)
    cancelBtn?.addEventListener('click', closeModal)

    // CLICK OUTSIDE MODAL
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal()
        }
    })

})
