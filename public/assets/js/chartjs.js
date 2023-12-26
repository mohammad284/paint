$(function() {
  'use strict';


  var colors = {
    primary        : "#6571ff",
    secondary      : "#7987a1",
    success        : "#05a34a",
    info           : "#66d1d1",
    warning        : "#fbbc06",
    danger         : "#ff3366",
    light          : "#e9ecef",
    dark           : "#060c17",
    muted          : "#7987a1",
    gridBorder     : "rgba(77, 138, 240, .15)",
    bodyColor      : "#000",
    cardBg         : "#fff"
  }

  var fontFamily = "'Roboto', Helvetica, sans-serif"




  // Bar chart
  if($('#chartjsBar').length) {
    new Chart($("#chartjsBar"), {
      type: 'bar',
      data: {
        labels: [ "China", "America", "India", "Germany", "Oman"],
        datasets: [
          {
            label: "Population",
            backgroundColor: [colors.primary, colors.danger, colors.warning, colors.success, colors.info],
            data: [2478,5267,734,2084,1433],
          }
        ]
      },
      options: {
        plugins: {
          legend: { display: false },
        },
        scales: {
          x: {
            display: true,
            grid: {
              display: true,
              color: colors.gridBorder,
              borderColor: colors.gridBorder,
            },
            ticks: {
              color: colors.bodyColor,
              font: {
                size: 12
              }
            }
          },
          y: {
            grid: {
              display: true,
              color: colors.gridBorder,
              borderColor: colors.gridBorder,
            },
            ticks: {
              color: colors.bodyColor,
              font: {
                size: 12
              }
            }
          }
        }
      }
    });
  }




  // Line Chart
  if($('#chartjsLine').length) {
    new Chart($('#chartjsLine'), {
      type: 'line',
      data: {
        labels: [1500,1600,1700,1750,1800,1850,1900,1950,1999,2050],
        datasets: [{ 
            data: [86,114,106,106,107,111,133,221,783,2478],
            label: "Africa",
            borderColor: colors.info,
            backgroundColor: "transparent",
            fill: true,
            pointBackgroundColor: colors.cardBg,
            pointBorderWidth: 2,
            pointHoverBorderWidth: 3,
            tension: .3
          }, { 
            data: [282,350,411,502,635,809,947,1402,3700,5267],
            label: "Asia",
            borderColor: colors.danger,
            backgroundColor: "transparent",
            fill: true,
            pointBackgroundColor: colors.cardBg,
            pointBorderWidth: 2,
            pointHoverBorderWidth: 3,
            tension: .3
          }
        ]
      },
      options: {
        plugins: {
          legend: { 
            display: true,
            labels: {
              color: colors.bodyColor,
              font: {
                size: '13px',
                family: fontFamily
              }
            }
          },
        },
        scales: {
          x: {
            display: true,
            grid: {
              display: true,
              color: colors.gridBorder,
              borderColor: colors.gridBorder,
            },
            ticks: {
              color: colors.bodyColor,
              font: {
                size: 12
              }
            }
          },
          y: {
            grid: {
              display: true,
              color: colors.gridBorder,
              borderColor: colors.gridBorder,
            },
            ticks: {
              color: colors.bodyColor,
              font: {
                size: 12
              }
            }
          }
        }
      }
    });
  }




  // Doughnut Chart
  if($('#chartjsDoughnut').length) {
    new Chart($('#chartjsDoughnut'), {
      type: 'doughnut',
      data: {
        labels: ["Africa", "Asia", "Europe"],
        datasets: [
          {
            label: "Population (millions)",
            backgroundColor: [colors.primary, colors.danger, colors.info],
            borderColor: colors.cardBg,
            data: [2478,4267,1334],
          }
        ]
      },
      options: {
        aspectRatio: 2,
        plugins: {
          legend: { 
            display: true,
            labels: {
              color: colors.bodyColor,
              font: {
                size: '13px',
                family: fontFamily
              }
            }
          },
        }
      }
    });
  }




  // Area Chart
  if($('#chartjsArea').length) {
    const input1 = document.getElementById("A_report");
    var a = input1.value ;
    const input2 = document.getElementById("B_report");
    var b = input2.value ;
    const input3 = document.getElementById("C_report");
    var c = input3.value ;
    const input4 = document.getElementById("D_report");
    var d = input4.value ;
    const input5 = document.getElementById("E_report");
    var e = input5.value ;
    const input6 = document.getElementById("F_report");
    var f = input6.value ;
    const input7 = document.getElementById("G_report");
    var g = input7.value ;
    const input8 = document.getElementById("H_report");
    var h = input8.value ;
    const input9 = document.getElementById("I_report");
    var k = input9.value ;
    const input10 = document.getElementById("J_report");
    var l = input10.value ;
    const input11 = document.getElementById("K_report");
    var m = input11.value ;
    const input12 = document.getElementById("L_report");
    var n = input12.value ;
    const input13 = document.getElementById("last_month");
    var last_month = input13.value ;
    const input14 = document.getElementById("this_month");
    var this_month = input14.value ;
    console.log(this_month);
    new Chart($('#chartjsArea'), {
      
      type: 'line',
      data: {
        labels: [5,10,15,20,25,30],
        datasets: [{ 
            data: [a,b,c,d,e,f],
            label: last_month,
            borderColor: colors.danger,
            backgroundColor: 'rgba(255,51,102,.3)',
            fill: true,
            pointBackgroundColor: colors.cardBg,
            pointBorderWidth: 2,
            pointHoverBorderWidth: 3,
            tension: .3
          }, { 
            data: [g,h,k,l,m,n],
            label: this_month,
            borderColor: colors.info,
            backgroundColor: 'rgba(102,209,209,.3)',
            fill: true,
            pointBackgroundColor: colors.cardBg,
            pointBorderWidth: 2,
            pointHoverBorderWidth: 3,
            tension: .3
          }
        ]
      },
      options: {
        plugins: {
          legend: { 
            display: true,
            labels: {
              color: colors.bodyColor,
              font: {
                size: '13px',
                family: fontFamily
              }
            }
          },
        },
        scales: {
          x: {
            display: true,
            grid: {
              display: true,
              color: colors.gridBorder,
              borderColor: colors.gridBorder,
            },
            ticks: {
              color: colors.bodyColor,
              font: {
                size: 12
              }
            }
          },
          y: {
            grid: {
              display: true,
              color: colors.gridBorder,
              borderColor: colors.gridBorder,
            },
            ticks: {
              color: colors.bodyColor,
              font: {
                size: 12
              }
            }
          }
        }
      }
    });
  }




  // Pie Chart
  if($('#chartjsPie').length) {
    new Chart($('#chartjsPie'), {
      type: 'pie',
      data: {
        labels: ["Africa", "Asia", "Europe"],
        datasets: [{
          label: "Population (millions)",
          backgroundColor: [colors.primary, colors.danger, colors.info],
          borderColor: colors.cardBg,
          data: [2478,4267,1334]
        }]
      },
      options: {
        plugins: {
          legend: { 
            display: true,
            labels: {
              color: colors.bodyColor,
              font: {
                size: '13px',
                family: fontFamily
              }
            }
          },
        },
        aspectRatio: 2,
      }
    });
  }




  // Bubble Chart
  if($('#chartjsBubble').length) {
    new Chart($('#chartjsBubble'), {
      type: 'bubble',
      data: {
        labels: "Africa",
        datasets: [
          {
            label: ["China"],
            backgroundColor: 'rgba(102,209,209,.3)',
            borderColor: colors.info,
            data: [{
              x: 21269017,
              y: 5.245,
              r: 15
            }]
          }, {
            label: ["Denmark"],
            backgroundColor: "rgba(255,51,102,.3)",
            borderColor: colors.danger,
            data: [{
              x: 258702,
              y: 7.526,
              r: 10
            }]
          }, {
            label: ["Germany"],
            backgroundColor: "rgba(101,113,255,.3)",
            borderColor: colors.primary,
            data: [{
              x: 3979083,
              y: 6.994,
              r: 15
            }]
          }, {
            label: ["Japan"],
            backgroundColor: "rgba(251,188,6,.3)",
            borderColor: colors.warning,
            data: [{
              x: 4931877,
              y: 5.921,
              r: 15
            }]
          }
        ]
      },
      options: {
        plugins: {
          legend: { 
            display: true,
            labels: {
              color: colors.bodyColor,
              font: {
                size: '13px',
                family: fontFamily
              }
            }
          },
        },
        scales: {
          x: { 
            display: true,
            title: {
              display: true,
              text: "GDP (PPP)"
            },
            grid: {
              display: true,
              color: colors.gridBorder,
              borderColor: colors.gridBorder,
            },
            ticks: {
              color: colors.bodyColor,
              font: {
                size: 12
              }
            }
          },
          y: { 
            display: true,
            title: {
              display: true,
              text: "Happiness"
            },
            grid: {
              display: true,
              color: colors.gridBorder,
              borderColor: colors.gridBorder,
            },
            ticks: {
              color: colors.bodyColor,
              font: {
                size: 12
              }
            }
          },
        }
      }
    });
  }




  // Radar Chart
  if($('#chartjsRadar').length) {
    new Chart($('#chartjsRadar'), {
      type: 'radar',
      data: {
        labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
        datasets: [
          {
            label: "1950",
            fill: true,
            backgroundColor: "rgba(255,51,102,.3)",
            borderColor: colors.danger,
            pointBorderColor: colors.danger,
            pointBackgroundColor: colors.cardBg,
            pointBorderWidth: 2,
            pointHoverBorderWidth: 3,
            data: [8.77,55.61,21.69,6.62,6.82]
          }, {
            label: "2050",
            fill: true,
            backgroundColor: "rgba(102,209,209,.3)",
            borderColor: colors.info,
            pointBorderColor: colors.info,
            pointBackgroundColor: colors.cardBg,
            pointBorderWidth: 2,
            pointHoverBorderWidth: 3,
            data: [25.48,54.16,7.61,8.06,4.45]
          }
        ]
      },
      options: {
        aspectRatio: 2,
        scales: {
          r: {
            angleLines: {
              display: true,
              color: colors.gridBorder,
            },
            grid: {
              color: colors.gridBorder
            },
            suggestedMin: 0,
            suggestedMax: 60,
            ticks: {
              backdropColor: colors.cardBg,
              color: colors.bodyColor,
              font: {
                size: 11,
                family: fontFamily
              }
            },
            pointLabels: {
              color: colors.bodyColor,
              font: {
                color: colors.bodyColor,
                family: fontFamily,
                size: '13px'
              }
            }
          }
        },
        plugins: {
          legend: { 
            display: true,
            labels: {
              color: colors.bodyColor,
              font: {
                size: '13px',
                family: fontFamily
              }
            }
          },
        },
      }
    });
  }




  // Polar Area Chart
  if($('#chartjsPolarArea').length) {
    new Chart($('#chartjsPolarArea'), {
      type: 'polarArea',
      data: {
        labels: ["Africa", "Asia", "Europe", "Latin America"],
        datasets: [
          {
            label: "Population (millions)",
            backgroundColor: [colors.primary, colors.danger, colors.success, colors.info],
            borderColor: colors.cardBg,
            data: [3578,5000,1034,2034]
          }
        ]
      },
      options: {
        aspectRatio: 2,
        scales: {
          r: {
            angleLines: {
              display: true,
              color: colors.gridBorder,
            },
            grid: {
              color: colors.gridBorder
            },
            suggestedMin: 1000,
            suggestedMax: 5500,
            ticks: {
              backdropColor: colors.cardBg,
              color: colors.bodyColor,
              font: {
                size: 11,
                family: fontFamily
              }
            },
            pointLabels: {
              color: colors.bodyColor,
              font: {
                color: colors.bodyColor,
                family: fontFamily,
                size: '13px'
              }
            }
          }
        },
        plugins: {
          legend: { 
            display: true,
            labels: {
              color: colors.bodyColor,
              font: {
                size: '13px',
                family: fontFamily
              }
            }
          },
        },
      }
    });
  }




  // Grouped Bar Chart
  if($('#chartjsGroupedBar').length) {
    new Chart($('#chartjsGroupedBar'), {
      type: 'bar',
      data: {
        labels: ["1900", "1950", "1999", "2050"],
        datasets: [
          {
            label: "Africa",
            backgroundColor: colors.danger,
            data: [133,221,783,2478]
          }, {
            label: "Europe",
            backgroundColor: colors.primary,
            data: [408,547,675,734]
          }
        ]
      },
      options: {
        plugins: {
          legend: { 
            display: true,
            labels: {
              color: colors.bodyColor,
              font: {
                size: '13px',
                family: fontFamily
              }
            }
          },
        },
        scales: {
          x: {
            display: true,
            grid: {
              display: true,
              color: colors.gridBorder,
              borderColor: colors.gridBorder,
            },
            ticks: {
              color: colors.bodyColor,
              font: {
                size: 12
              }
            }
          },
          y: {
            grid: {
              display: true,
              color: colors.gridBorder,
              borderColor: colors.gridBorder,
            },
            ticks: {
              color: colors.bodyColor,
              font: {
                size: 12
              }
            }
          }
        }
      }
    });
  }




  // Mixed Line Bar Chart
  if($('#chartjsMixedBar').length) {
    new Chart($('#chartjsMixedBar'), {
      type: 'bar',
      data: {
        labels: ["1900", "1950", "1999", "2050"],
        datasets: [{
            label: "Europe",
            type: "line",
            borderColor: colors.danger,
            backgroundColor: "transparent",
            data: [408,547,675,734],
            fill: false,
            pointBackgroundColor: colors.cardBg,
            pointBorderWidth: 2,
            pointHoverBorderWidth: 3,
            tension: .3
          }, {
            label: "Africa",
            type: "line",
            borderColor: colors.primary,
            backgroundColor: "transparent",
            data: [133,221,783,2478],
            fill: false,
            pointBackgroundColor: colors.cardBg,
            pointBorderWidth: 2,
            pointHoverBorderWidth: 3,
            tension: .3
          }, {
            label: "Europe",
            type: "bar",
            backgroundColor: colors.danger,
            data: [408,547,675,734],
          }, {
            label: "Africa",
            type: "bar",
            backgroundColor: colors.primary,
            data: [133,221,783,2478]
          }
        ]
      },
      options: {
        plugins: {
          legend: { 
            display: true,
            labels: {
              color: colors.bodyColor,
              font: {
                size: '13px',
                family: fontFamily
              }
            }
          },
        },
        scales: {
          x: {
            display: true,
            grid: {
              display: true,
              color: colors.gridBorder,
              borderColor: colors.gridBorder,
            },
            ticks: {
              color: colors.bodyColor,
              font: {
                size: 12
              }
            }
          },
          y: {
            grid: {
              display: true,
              color: colors.gridBorder,
              borderColor: colors.gridBorder,
            },
            ticks: {
              color: colors.bodyColor,
              font: {
                size: 12
              }
            }
          }
        }
      }
    });
  }

});