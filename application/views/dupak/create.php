<h3 class="text-center">Formulir Penilaian Angka Kredit</h3>

<h5>Usulan Ke-<?= $number_usulan ?></h5>
<h5>Nama Pengusul : <?= $this->session->userdata('user')->nama ?></h5>
<h5>Jabatan : <?= $this->session->userdata('nama_jabatan') ?></h5>

<div class="card">
    <div class="card-body">

        <form id="form" action="<?php echo base_url('dupak/pemberkasan/do_create/'); ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <ul id="progressbar">
                    <?php
                    $no = 1;
                    $current_u = '';
                    $arr_unsur = [];
                    foreach ($unsur as $key => $value) {
                        if ($value->unsur != $current_u) {
                            if ($no == 1) {
                                echo '<li class="active text-capitalize" id="step' . $no . '"><strong>' . $value->unsur . '</strong></li>';
                            } else {
                                echo '<li class="text-capitalize" id="step' . $no . '"><strong>' . $value->unsur . '</strong></li>';
                            }
                            $current_u = $value->unsur;
                            array_push($arr_unsur, $value->unsur);
                            $no++;
                        }
                    } ?>
                </ul>
                <div class="progress">
                    <div class="progress-bar"></div>
                </div>
            </div>
            <?php
            $current_u = '';
            $inc_char = 65;
            $format_table = '';
            foreach ($unsur as $k => $u) {
                if ($u->unsur != $current_u) {
                    $format_table .= ' 
                    <fieldset>   
                    <div class="table-responsive">                                  
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th style="text-align:center">No</th>
                                        <th colspan="2">Komponen Kegiatan</th>
                                        <th>Batas Maksimal Diakui</th>
                                        <th>Bukti Kegiatan</th>
                                        <th style="word-wrap: break-word;min-width: 120px;max-width: 120px;white-space:normal;">Angka Kredit Tertinggi</th>
                                        <th> Angka Kredit </th>
                                    </tr>
                                </thead>
                                <tbody class="text-left">
                                    <tr>
                                        <td>' . chr($k + $inc_char) . '</td>
                                        <td colspan="6" class="text-left text-capitalize">' . $u->unsur . '</td>
                                    </tr>';
                    $current_u = $u->unsur;
                } else {
                    $inc_char--;
                }

                $jmlh_sub_kegiatan = 1;
                $format_unsur_kegiatan = '';
                foreach ($unsur_kegiatan as $key => $uk) {
                    if ($u->id == $uk->unsur_id) {
                        $format_unsur_kegiatan .= '
                                    <tr>
                                        <td>' . $uk->kode . '. ' . $uk->kegiatan . '</td>
                                        <td>' . $uk->satuan . '</td>
                                        <td>
                                            <input type="file"  name="file_bukti-' . $uk->id . '">
                                        </td>
                                        <td>' . $uk->angka_kredit . '</td>
                                        <td><input class="form-control" type="number" step="any" name="nilai-' . $uk->id . '"></td>
                                    </tr>';
                        $jmlh_sub_kegiatan++;
                    }
                }
                $format_sub_unsur = '
                                    <tr>
                                        <td rowspan="' . $jmlh_sub_kegiatan . '"></td>
                                        <td rowspan="' . $jmlh_sub_kegiatan . '">' . ($k + 1) . '</td>
                                        <td  style="word-wrap: break-word;min-width: 160px;max-width: 160px;white-space:normal;">' . $u->sub_unsur . ':</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>                            
                                        <td></td>                            
                                    </tr>';
                $format_table .= $format_sub_unsur;
                $format_table .= $format_unsur_kegiatan;

                // if next unsur is different
                if (isset($unsur[$k + 1])) {
                    if ($u->unsur != $unsur[$k + 1]->unsur) {
                        // if first unsur
                        if ($k == 1) {
                            $format_table .= '
                                                </tbody>
                                            </table>
                                        </div>
                                        <input type="button" name="next-step" class="btn btn-primary mt-3 next-step" value="Selanjutnya" />
                                    </fieldset>';
                        } else {
                            $format_table .= '
                                                 </tbody>
                                            </table>
                                        </div>
                                        <input type="button" name="previous-step" class="btn btn-secondary mt-3 previous-step" value="Kembali" />
                                        <input type="button" name="next-step" class="btn btn-primary mt-3 next-step" value="Selanjutnya" />
                                    </fieldset>';
                        }   
                    }
                } else {
                    $format_table .= '
                                        </tbody>
                                    </table>
                                </div>
                                <input type="button" name="previous-step" class="btn btn-secondary mt-3 previous-step" value="Kembali" />
                                <button type="submit" name="submit" class="btn btn-primary mt-3" value="Previous Step">Simpan</button>
                            </fieldset>';
                }
            }
            echo $format_table;
            ?>

        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        var currentGfgStep, nextGfgStep, previousGfgStep;
        var opacity;
        var current = 1;
        var steps = $("fieldset").length;
        var progress = 100 / steps;

        // set width of progress bar
        $("#progressbar li").css("width", progress + "%");
        console.log(progress);

        setProgressBar(current);

        $(".next-step").click(function() {

            currentGfgStep = $(this).parent();
            nextGfgStep = $(this).parent().next();

            $("#progressbar li").eq($("fieldset")
                .index(nextGfgStep)).addClass("active");

            nextGfgStep.show();
            currentGfgStep.animate({
                opacity: 0
            }, {
                step: function(now) {
                    opacity = 1 - now;

                    currentGfgStep.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    nextGfgStep.css({
                        'opacity': opacity
                    });
                },
                duration: 500
            });
            setProgressBar(++current);
        });

        $(".previous-step").click(function() {

            currentGfgStep = $(this).parent();
            previousGfgStep = $(this).parent().prev();

            $("#progressbar li").eq($("fieldset")
                .index(currentGfgStep)).removeClass("active");

            previousGfgStep.show();

            currentGfgStep.animate({
                opacity: 0
            }, {
                step: function(now) {
                    opacity = 1 - now;

                    currentGfgStep.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previousGfgStep.css({
                        'opacity': opacity
                    });
                },
                duration: 500
            });
            setProgressBar(--current);
        });

        function setProgressBar(currentStep) {
            var percent = parseFloat(100 / steps) * current;
            percent = percent.toFixed();
            $(".progress-bar")
                .css("width", percent + "%")
        }

        $(".submit").click(function() {
            return false;
        })
    });
</script>