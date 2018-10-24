#!/usr/bin/env Rscript
args = commandArgs(trailingOnly=TRUE)


profil_hydrophobicite <- function(seq,w){
  hp <- c(4.5,4.2,3.8,2.8,2.5,1.9,1.8,-0.4,-0.7,-0.8,-0.9,-1.3,-1.6,-3.2,-3.5,-3.5,-3.5,-3.5,-3.9,-4.5)
  aa <- c("I","V","L","F","C","M","A","G","T","S","W","Y","P","H","E","Q","D","N","K","R")
  seq <- unlist(strsplit(seq,""))
  score = NULL
  for (i in 1:length(seq)) {
    if(seq[i] != "*")
    {
      if(i < w/2 || i > (length(seq) - w/2 - 1)){
        score[i] <- hp[which(seq[i] == aa)]
      }
      else{
        score[i] = 0
        for (j in (i-floor(w/2)):(i+floor(w/2))) {
          score[i] <-  score[i] + hp[which(seq[j] == aa)]
        }
        score[i] <- score[i]/w
      }
    }
  }
  # return(score)
  jpeg("../img/rplot.jpg")
  plot(score, xlim = c(ceiling(w/2),length(seq)-ceiling(w/2)),xlab = "Position", ylab = "Score", type = "l")
  abline(h = 0, col = "RED", lty = 2)
  dev.off()
}
profil_hydrophobicite(args[1],as.numeric(args[2]))

