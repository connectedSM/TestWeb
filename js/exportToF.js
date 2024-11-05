function generatePDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Definir el encabezado del documento
    doc.setFontSize(14);
    doc.text('Tareas Finalizadas', 14, 20);

    // Obtener la tabla y convertirla a formato adecuado
    const table = document.querySelector('.task-table');
    const rows = table.querySelectorAll('tr');
    const data = [];

    // Recorremos las filas para generar un array de datos
    rows.forEach((row, index) => {
        const cells = row.querySelectorAll('th, td');
        const rowData = Array.from(cells).map(cell => cell.textContent);
        data.push(rowData);
    });

    // Usar autoTable para crear una tabla en el PDF
    doc.autoTable({
        head: [data[0]],  // Primer fila como encabezado
        body: data.slice(1),  // Resto del cuerpo de la tabla
        startY: 30,  // Comenzar la tabla después del título
        theme: 'striped',  // Estilo de la tabla
        headStyles: { fillColor: [52, 73, 94] },  // Color de fondo del encabezado
        margin: { top: 30 }
    });

    // Descargar el archivo PDF
    doc.save('tareas_finalizadas.pdf');
}

function exportToExcelXLSX() {
    // Obtener la tabla
    const table = document.querySelector('.task-table');
    const rows = table.querySelectorAll('tr');

    // Crear un array de arrays para contener los datos de la tabla
    const data = [];

    rows.forEach(row => {
        const cells = row.querySelectorAll('th, td');
        const rowData = Array.from(cells).map(cell => cell.textContent); // Extraer el texto de cada celda
        data.push(rowData); // Añadir la fila de datos
    });

    // Crear una hoja de cálculo
    const ws = XLSX.utils.aoa_to_sheet(data);

    // Crear un libro de trabajo
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "Tareas Finalizadas");

    // Generar archivo y descargar
    XLSX.writeFile(wb, 'tareas_finalizadas.xlsx');
}
