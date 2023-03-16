function attendanceReport() {
  function dates() {
    let dateObj = new Date();
    let dateList = [];
    for (let i = 0; i < 15; i++) {
      let nextDate = new Date();
      nextDate.setDate(dateObj.getDate() - i);
      let formatedDate = `${nextDate.getFullYear()}/${
        nextDate.getMonth() < 9
          ? "0" + (nextDate.getMonth() + 1)
          : nextDate.getMonth() + 1
      }/${
        nextDate.getDate() < 10 ? "0" + nextDate.getDate() : nextDate.getDate()
      }`;
      dateList.push(formatedDate);
    }
    return dateList.reverse();
  }
  //post req for attendance
  attendanceValues();
  async function attendanceValues() {
    const formData = new FormData();
    formData.append("action", "attendanceValues");
    let datesReverse = dates();
    console.log(datesReverse[0]);
    console.log(datesReverse[datesReverse.length - 1]);
    // formData.append("dateFirst", "2023/03/12");
    // formData.append("dateLast", "2023/03/12");
    formData.append("dateFirst", datesReverse[0]);
    formData.append("dateLast", datesReverse[datesReverse.length - 1]);
    const attendanceData = await axios
      .post("action.php", formData)
      .then(({ data, status }) => {
        return data;
      });
    const stuDataLength = await axios
      .post("action.php", "action=listStudents")
      .then((res) => res.data.length);
    // console.log(stuData.length);
    let attendanceList = [];
    lastCounter = 0;
    dates().forEach((x) => {
      let counter = 0;
      attendanceData.forEach((y) => {
        if (y.attendance_date === x) {
          counter++;
        }
      });
      lastCounter = counter;
      attendanceList.push(counter);
    });
    // console.log(attendanceList);
    document.getElementById("stuPresentCount").innerText = lastCounter + "/";
    document.getElementById("stuTotalCount").innerText = stuDataLength;
    var xValues = dates();
    var yValues = attendanceList;

    new Chart("attendanceChart", {
      type: "line",
      data: {
        labels: xValues,
        datasets: [
          {
            fill: false,
            lineTension: 0,
            backgroundColor: "rgba(0,0,255,1.0)",
            borderColor: "rgba(0,0,255,0.1)",
            data: yValues,
          },
        ],
      },
      options: {
        legend: { display: false },
        scales: {
          yAxes: [{ ticks: { min: 0, max: stuDataLength } }],
        },
      },
    });
  }
}

attendanceReport();
