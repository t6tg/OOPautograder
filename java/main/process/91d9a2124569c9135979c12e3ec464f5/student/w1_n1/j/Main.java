
// package Main.java;

import java.util.Scanner;

public class Main{
    public static void main(String[] args) {
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
            ans = num1 - num2;
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
