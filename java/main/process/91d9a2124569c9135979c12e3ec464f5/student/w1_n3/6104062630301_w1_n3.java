/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package comproweek3;

import java.util.Scanner;

/**
 *
 * @author thanawatgualti
 */
public class Ex3 {

    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);
        System.out.print("Please enter your name: ");
        String name = input.next();
        System.out.format("Are you male or female, %s (M, F): ", name);
        char sex = input.next().charAt(0);
        if ((sex == 'F') || (sex == 'f')) {
            System.out.format("%s, what is your height c.m. and weight in k.g: ", name);
            float height = input.nextFloat();
            float weight = input.nextFloat();
            float female = (float) height - 110;
            float dif = (float) female - weight;
            if (dif >= 0) {
                System.out.format("%s, your ideal weight is %.0f kg, you are %.0f kg underweight\n", name, female, dif);
            } else {
                System.out.format("%s, your ideal weight is %.0f kg, you are %.0f kg overweight\n", name,female,Math.abs(dif));
            }
        }
        else if ((sex == 'M') || (sex == 'm')) {
            System.out.format("%s, what is your height c.m. and weight in k.g: ", name);
            float height = input.nextFloat();
            float weight = input.nextFloat();
            float male = (float) height - 105;
            float dif = (float) male - weight;
            if (dif >= 0) {
                System.out.format("%s, your ideal weight is %.0f kg, you are %.0f kg underweight\n", name, male, dif);
            } else {
                System.out.format("%s, your ideal weight is %.0f kg, you are %.0f kg overweight\n", name,male,Math.abs(dif));
            }
        }
    }
}
