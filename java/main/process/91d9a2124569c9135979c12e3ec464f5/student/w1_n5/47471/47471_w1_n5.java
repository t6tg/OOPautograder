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
public class Ex1 {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        // TODO code application logic here
        float ans;
        Scanner input = new Scanner(System.in);
        System.out.print("Please enter number1: ");
        float num1 = input.nextFloat();
        System.out.print("Please enter number2: ");
        float num2 = input.nextFloat();
        System.out.print("Please enter operator: ");
        char oper = input.next().charAt(0);
        if (oper == '+') {
            ans = num1 + num2;
            System.out.println("Result is = " + ans);
        } else if (oper == '-') {
            ans = num1 + num2;
            System.out.println("Result is = " + ans);
        } else if (oper == '*') {
            ans = num1 * num2;
            System.out.println("Result is = " + ans);
        } else if (oper == '/') {
            ans = num1 / num2;
            System.out.println("Result is = " + ans);
        } else {
            System.out.println("Error");
        }
    }

}
