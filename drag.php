<div class="container">
  <section class="dropzone source">
    <div class="draggable" id="drag-1" draggable="true">drag-1</div>
    <div class="draggable" id="drag-2" draggable="true">drag-2</div>
    <div class="draggable" id="drag-3" draggable="true">drag-3</div>
    <div class="draggable" id="drag-4" draggable="true">drag-4</div>
    <div class="draggable" id="drag-5" draggable="true">drag-5</div>
  </section>
  <section class="dropzone target">

  </section>
</div>
<style>
    * {
  box-sizing: border-box;
}

.container {
  display: flex;
  justify-content: space-between;
  margin: 2ch;
}

.dropzone {
  width: calc(50% - 1ch);
  padding: 2ch;
  border: 1px solid gray;
}

.draggable {
  border: 1px solid lightgray;
  padding: 1.5ch;
  background-color: #efefef;
  cursor: move;
  margin-top: 1.5ch;
  
  + .draggable {
    margin-top: 1.5ch;
  }

  .is-dragging {
    opacity: 0.5;
  }
}

</style>

<script>
    const dropzoneSource = document.querySelector(".source");
    const dropzone = document.querySelector(".target");
    const dropzones = [...document.querySelectorAll(".dropzone")];
    const draggables = [...document.querySelectorAll(".draggable")];

    function getDragAfterElement(container, y) {
      const draggableElements = [
        ...container.querySelectorAll(".draggable:not(.is-dragging)")
      ];
    
      return draggableElements.reduce(
        (closest, child) => {
          const box = child.getBoundingClientRect();
          const offset = y - box.top - box.height / 2;
    
          if (offset < 0 && offset > closest.offset) {
            return {
              offset,
              element: child
            };
          } else {
            return closest;
          }
        },
        { offset: Number.NEGATIVE_INFINITY }
      ).element;
    }
    
    draggables.forEach((draggable) => {
      draggable.addEventListener("dragstart", (e) => {
        draggable.classList.add("is-dragging");
      });
    
      draggable.addEventListener("dragend", (e) => {
        draggable.classList.remove("is-dragging");
      });
    });
    
    dropzones.forEach((zone) => {
      zone.addEventListener("dragover", (e) => {
        e.preventDefault();
        const afterElement = getDragAfterElement(zone, e.clientY);
        const draggable = document.querySelector(".is-dragging");
        if (afterElement === null) {
          zone.appendChild(draggable);
        } else {
          zone.insertBefore(draggable, afterElement);
        }
      });
    });

</script>